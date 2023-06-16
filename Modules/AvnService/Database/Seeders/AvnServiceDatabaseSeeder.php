<?php

namespace Modules\AvnService\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;
use App\Models\Role;
use App\Models\UserRole;
use App\Models\PermissionRole;
use App\Models\AvnMenu;
use App\Models\User;
use App\Models\GeneralSettings;
use App\Models\ModulesSettingsLink;
use Modules\AvnService\Entities\Service;

class AvnServiceDatabaseSeeder extends Seeder
{
    public function run()
    {
        $menu_service = new AvnMenu();
        $menu_service->label = 'Dịch vụ';
        $menu_service->en = 'Services';
        $menu_service->vi = 'Dịch vụ';
        $menu_service->ja = 'サービス';
        $menu_service->route_name = 'service-setting';
        $menu_service->icon = 'uil-rss';
        $menu_service->module = "AvnSetting";
        $menu_service->parent = AvnMenu::where('route_name', 'page-setting')->first()->id;
        $menu_service->save();

        $permission1 = new Permission();
        $permission1->route_names = 'service-setting, update-service-setting, add-service, edit-service, store-service, update-service, delete-service';
        $permission1->name = 'Quản lý dịch vụ';
        $permission1->menu_id = $menu_service->id;
        $permission1->save();

        $pr1 = new PermissionRole();
        $pr1->role_id = 1;
        $pr1->permission_id = $permission1->id;
        $pr1->save();

        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'service_seo_title';
        $setting->value = 'Services';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'service_seo_description';
        $setting->value = "The clean and well commented code allows easy customization of the theme.It's designed for
        describing your app, agency or business.";
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'service_seo_keywords';
        $setting->value = 'Pricing, Services';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'service_seo_image';
        $setting->value = 'resources/assets/images/logo3.png';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'service_page_title_en';
        $setting->value = 'Choose Simple Pricing';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'service_page_title_vi';
        $setting->value = 'Chọn Gói Giá Đơn Giản';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'service_page_title_ja';
        $setting->value = 'シンプルな価格設定を選ぶ';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'service_page_description_en';
        $setting->value = "The clean and well commented code allows easy customization of the theme.It's designed for
        describing your app, agency or business.";
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'service_page_description_vi';
        $setting->value = "Mã nguồn sạch và được chú thích rõ ràng cho phép dễ dàng tùy chỉnh giao diện. Nó được thiết kế để mô tả ứng dụng, công ty hoặc doanh nghiệp của bạn.";
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'service_page_description_ja';
        $setting->value = "クリーンでコメントが豊富なコードにより、テーマのカスタマイズが容易に行えます。アプリ、代理店、またはビジネスの説明に最適に設計されています。";
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'service_page_icon_en';
        $setting->value = 'resources/assets/images/083934.png';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'service_page_icon_vi';
        $setting->value = 'resources/assets/images/083934.png';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'service_page_icon_ja';
        $setting->value = 'resources/assets/images/083934.png';
        $setting->save();

        $service = new Service();
        $service->name_ja = 'スタンダードサービス';
        $service->name_vi = 'DỊCH VỤ TIÊU CHUẨN';
        $service->name_en = 'STANDARD SERVICE';
        $service->img = 'resources/assets/images/54684616.png';
        $service->price = '$49 / LICENSE';
        $service->description_ja = '<p>10 GB Storage</p><p>500 GB Bandwidth</p><p>No Domain</p><p>1 User</p><p>Email Support</p><p>24x7 </p>';
        $service->description_vi = '<p>10 GB Lưu trữ</p><p>500 GB Băng thông</p><p>Không có Tên miền</p><p>1 Người dùng</p><p>Hỗ trợ qua Email</p><p>24x7</p>';
        $service->description_en = '<p>10 GB ストレージ</p><p>500 GB 帯域幅</p><p>ドメインなし</p><p>1 ユーザー</p><p>メールサポート</p><p>24x7</p>';
        $service->recommended = 0;
        $service->save();
        $service = new Service();
        $service->name_ja = 'マルチサービス';
        $service->name_vi = 'DỊCH VỤ ĐA LỰA CHỌN';
        $service->name_en = 'MULTIPLE SERVICE';
        $service->img = 'resources/assets/images/63456463.png';
        $service->price = '$99 / LICENSE';
        $service->description_ja = '<p>50 GB ストレージ</p><p>900 GB バンド幅</p><p>2 ドメイン</p><p>10 ユーザー</p><p>メールサポート</p><p>24x7</p>';
        $service->description_vi = '<p>50 GB Lưu trữ</p><p>900 GB Băng thông</p><p>2 Tên miền</p><p>10 Người dùng</p><p>Hỗ trợ qua email</p><p>24/7</p>';
        $service->description_en = '<p>50 GB Storage</p><p>900 GB Bandwidth</p><p>2 Domain</p><p>10 User</p><p>Email Support</p><p>24x7 </p>';
        $service->recommended = 1;
        $service->save();
        $service = new Service();
        $service->name_ja = '拡張サービス';
        $service->name_vi = 'EXTENDED LICENSE';
        $service->name_en = 'DỊCH VỤ MỞ RỘNG';
        $service->img = 'resources/assets/images/4355555543.png';
        $service->price = '$599 / LICENSE';
        $service->description_ja = '<p>100 GB ストレージ</p><p>無制限の帯域幅</p><p>10 ドメイン</p><p>無制限のユーザー</p><p>メールサポート</p><p>24x7 </p>';
        $service->description_vi = '<p>100 GB Lưu trữ</p><p>Băng thông không giới hạn</p><p>10 Tên miền</p><p>Số người dùng không giới hạn</p><p>Hỗ trợ qua email</p><p>24x7 </p>';
        $service->description_en = '<p>100 GB Storage</p><p>Unlimited Bandwidth</p><p>10 Domain</p><p>Unlimited User</p><p>Email Support</p><p>24x7 </p>';
        $service->recommended = 0;
        $service->save();
    }
}