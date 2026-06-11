<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Penghuni;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PenghuniResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PenghuniResource\RelationManagers;

class PenghuniResource extends Resource
{
    protected static ?string $model = Penghuni::class;

    protected static ?string $navigationGroup = 'Manajemen Penyewaan';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Forms\Components\Select::make('user_id')
                ->label('Akun Penghuni')
                ->required()
                ->relationship('user', 'email')
                ->searchable()
                ->preload()
                ->rules([
                    function () {
                        return function (string $attribute, $value, \Closure $fail) {
                            $existing = \App\Models\Penghuni::where('user_id', $value)
                                ->whereNull('tanggal_keluar')
                                ->exists();
                            if ($existing) {
                                $fail('User ini sudah memiliki kamar aktif.');
                            }
                        };
                    },
                ]),

            Forms\Components\Select::make('kamar_id')
                ->label('Kamar')
                ->required()
                ->relationship('kamar', 'nama_kamar', function ($query) {
                    $query->where('status', 'Kosong');
                })
                ->searchable()
                ->preload(),

            Forms\Components\TextInput::make('nama_penghuni')
                ->label('Nama Penghuni')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('no_ktp')
                ->label('No KTP')
                ->required()
                ->unique(ignoreRecord: true),

            Forms\Components\TextInput::make('no_telepon')
                ->label('No Telepon')
                ->tel()
                ->required(),

            Forms\Components\DatePicker::make('tanggal_masuk')
                ->label('Tanggal Masuk')
                ->required(),

            Forms\Components\DatePicker::make('tanggal_keluar')
                ->label('Tanggal Keluar')
                ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('nama_penghuni')
                    ->label('Nama')
                    ->sortable()
                    ->searchable(),
            Tables\Columns\TextColumn::make('user.email')
                ->label('Akun User')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('kamar.nama_kamar')
                ->label('Kamar')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('no_ktp')
                ->label('KTP')
                ->searchable(),

            Tables\Columns\TextColumn::make('no_telepon')
                ->label('Telepon'),

            Tables\Columns\TextColumn::make('tanggal_masuk')
                ->date('d M Y'),

            Tables\Columns\TextColumn::make('tanggal_keluar')
                ->date('d M Y')
                ->toggleable(),
        ])
        ->filters([])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
        Tables\Actions\BulkAction::make('generateTagihanDenganPeriode')
        ->label('Generate Tagihan dengan Periode')
        ->form([
            Forms\Components\Select::make('periode')
                ->label('Periode Tagihan')
                ->options([
                    'current' => 'Bulan Ini (' . Carbon::now()->format('F Y') . ')',
                    'next' => 'Bulan Depan (' . Carbon::now()->addMonth()->format('F Y') . ')',
                    'both' => 'Bulan Ini + Bulan Depan',
                ])
                ->default('current')
                ->required(),
        ])
        ->action(function ($records, $data) {

            $periode = $data['periode'];
            $createdCount = 0;

            DB::transaction(function () use ($records, $periode, &$createdCount) {

                foreach ($records as $penghuni) {

                    if ($periode === 'current' || $periode === 'both') {
                        // Generate tagihan bulan ini
                        $sudahAdaCurrent = $penghuni->tagihans()
                            ->where('midtrans_order_id', 'like', 'TAG-' . Carbon::now()->format('Y-m') . '-%')
                            ->exists();

                        if (!$sudahAdaCurrent) {
                            $jumlah = $penghuni->kamar->harga_bulanan ?? 0;

                            $penghuni->tagihans()->create([
                                'jumlah_tagihan' => $jumlah,
                                'status' => 'Belum Lunas',
                                'midtrans_order_id' => 'TAG-' . Carbon::now()->format('Y-m') . '-' . $penghuni->id,
                            ]);

                            $createdCount++;
                        }
                    }

                    if ($periode === 'next' || $periode === 'both') {
                        // Generate tagihan bulan depan
                        $nextMonth = Carbon::now()->addMonth();
                        $sudahAdaNext = $penghuni->tagihans()
                            ->where('midtrans_order_id', 'like', 'TAG-' . $nextMonth->format('Y-m') . '-%')
                            ->exists();

                        if (!$sudahAdaNext) {
                            $jumlah = $penghuni->kamar->harga_bulanan ?? 0;

                            $penghuni->tagihans()->create([
                                'jumlah_tagihan' => $jumlah,
                                'status' => 'Belum Lunas',
                                'midtrans_order_id' => 'TAG-' . $nextMonth->format('Y-m') . '-' . $penghuni->id,
                            ]);

                            $createdCount++;
                        }
                    }
                }
            });

            $periodeText = match($periode) {
                'current' => 'bulan ini',
                'next' => 'bulan depan',
                'both' => 'bulan ini dan bulan depan',
            };

            \Filament\Notifications\Notification::make()
                ->title('Generate Tagihan Berhasil')
                ->body("Berhasil membuat {$createdCount} tagihan untuk {$periodeText}")
                ->success()
                ->send();
        })
        ->successNotificationTitle('Tagihan berhasil dibuat!')
        ->after(function () {
            return redirect(TagihanResource::getUrl()); 
        }),
            Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenghunis::route('/'),
            'create' => Pages\CreatePenghuni::route('/create'),
            'edit' => Pages\EditPenghuni::route('/{record}/edit'),
        ];
    }
}
