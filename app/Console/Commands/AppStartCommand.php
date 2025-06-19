<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppStartCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('key:generate');
        $this->info('Uygulama başlatılıyor');
        $this->info('İlk önce veri tabanı tabloları oluşturuluyor. ve test kullanıcısı oluşturulacak');
        $this->call('migrate', ['--seed' => true]);
        $this->info('Veri tabanı tabloları ve test kullanıcısı oluşturuldu');
        $this->info('email: admin@cargoshipmanagement.com password: password');
        $this->info('Uygulama başlatıldı');
        $this->call('serve');
    }
}
