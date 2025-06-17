<?php

namespace App\Livewire\Admin;

use App\Traits\HasPermissionCheck;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;

#[Title('Company Setting')]
class CompanySetting extends Component
{
    use WithFileUploads, HasPermissionCheck;

    public $oldLogo, $oldLogoIcon;

    public $site_name, $site_email, $site_logo, $site_icon, $mail_mailer, $mail_host, $mail_port, $mail_username, $mail_password, $mail_encryption;

    public function mount()
    {
        $this->site_name = \App\Models\CompanySetting::get('site_name');
        $this->site_email = \App\Models\CompanySetting::get('site_email');
        $this->mail_mailer = \App\Models\CompanySetting::get('mail_mailer');
        $this->oldLogo = \App\Models\CompanySetting::get('site_logo');
        $this->oldLogoIcon = \App\Models\CompanySetting::get('site_icon');
        $this->mail_host = \App\Models\CompanySetting::get('mail_host');
        $this->mail_port = \App\Models\CompanySetting::get('mail_port');
        $this->mail_username = \App\Models\CompanySetting::get('mail_username');
        $this->mail_password = \App\Models\CompanySetting::get('mail_password');
        $this->mail_encryption = \App\Models\CompanySetting::get('mail_encryption');
    }

    public function updateCompanySettingInfo()
    {
        $this->authorizePermission('edit company setting');
        try {
            $this->validate([
                'site_name' => 'required|string',
                'site_email' => 'required|email',
                'site_logo' => 'nullable|max:1024', // 1MB max
                'site_icon' => 'nullable|max:512', // 512KB max
                'mail_mailer' => 'required|string',
                'mail_host' => 'required|string',
                'mail_port' => 'required|string',
                'mail_username' => 'required|string',
                'mail_password' => 'required|string',
                'mail_encryption' => 'required|string',
            ]);

            // Save all fields as key-value pairs
            $this->saveSetting('site_name', $this->site_name);
            $this->saveSetting('site_email', $this->site_email);
            $this->saveSetting('mail_mailer', $this->mail_mailer);
            $this->saveSetting('mail_host', $this->mail_host);
            $this->saveSetting('mail_port', $this->mail_port);
            $this->saveSetting('mail_username', $this->mail_username);
            $this->saveSetting('mail_password', $this->mail_password);
            $this->saveSetting('mail_encryption', $this->mail_encryption);

            // If there's a file
            if ($this->site_logo) {
                // Delete the old logo if it exists
                $oldLogo = \App\Models\CompanySetting::get('site_logo');
                if ($oldLogo) {
                    $oldLogoPath = public_path('storage/' . $oldLogo);
                    if (file_exists($oldLogoPath)) {
                        unlink($oldLogoPath);
                    }
                }

                // Store the new logo
                $logoPath = $this->site_logo->store('admin/company-setting', 'public');
                $this->saveSetting('site_logo', $logoPath);
            }

            if ($this->site_icon) {
                // Delete the old logo icon if it exists
                $oldIcon = \App\Models\CompanySetting::get('site_icon');
                if ($oldIcon) {
                    $oldLogoIcon = public_path('storage/' . $oldIcon);
                    if (file_exists($oldLogoIcon)) {
                        unlink($oldLogoIcon);
                    }
                }

                // Store the new logo icon
                $logoIcon = $this->site_icon->store('admin/company-setting', 'public');
                $this->saveSetting('site_icon', $logoIcon);
            }

            LivewireAlert::title('Company settings updated successfully.')
                ->success()
                ->timer(5000)
                ->position('bottom-end')
                ->toast()
                ->show();

        } catch (\Exception $e) {
            LivewireAlert::title($e->getMessage())
                ->error()
                ->timer(5000)
                ->position('bottom-end')
                ->toast()
                ->show();
        }

    }

    public function removeTempImage()
    {
        $this->authorizePermission('edit company setting');
        if ($this->site_logo) {
            $this->site_logo = null;
            LivewireAlert::title('Temporary image removed successfully.')
                ->success()
                ->timer(5000)
                ->position('bottom-end')
                ->toast()
                ->show();
        } else {
            LivewireAlert::title('This image not removeable.')
                ->warning()
                ->timer(5000)
                ->position('bottom-end')
                ->toast()
                ->show();
        }
    }

    public function removeTempSiteIcon()
    {
        $this->authorizePermission('edit company setting');
        if ($this->site_icon) {
            $this->site_icon = null;
            LivewireAlert::title('Temporary logo icon removed successfully.')
                ->success()
                ->timer(5000)
                ->position('bottom-end')
                ->toast()
                ->show();
        } else {
            LivewireAlert::title('This logo icon not removeable.')
                ->warning()
                ->timer(5000)
                ->position('bottom-end')
                ->toast()
                ->show();
        }
    }

    private function saveSetting($key, $value)
    {
        $this->authorizePermission('edit company setting');
        \App\Models\CompanySetting::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
    public function render()
    {
        $this->authorizePermission('view company setting');
        return view('livewire.admin.company-setting');
    }
}
