@php
    $footer = Modules\AvnSetting\Http\Controllers\FooterController::getFooter(); 
    $footer_icon = Modules\AvnSetting\Http\Controllers\FooterController::getFooterIcon();
    $description = App\Models\GeneralSettings::whereIn('key', ['footer_description'])->first(); 
    $logo = App\Http\Controllers\Controller::getSetting('logo')->value;
@endphp
<footer class="bg-dark py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <img src="{{ $logo ? asset('/storage/app/AvnGeneralSettings/' . $logo) : asset('/resources/assets/images/logo.png') }}" width="70" height="70" />
                <p class="text-muted mt-4">{{ $description->value ?? '' }}</p>
                <ul class="social-list list-inline mt-3">
                    @foreach($footer_icon as $item)
                        <li class="list-inline-item text-center">
                            <a href="{{ $item->link }}">
                                <img src="{{ asset($item->icon) }}" class="social-list-item" style="width: 40px; height: 40px; object-fit: cover" />
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    @foreach($footer as $item)
                        <div class="col-lg-3 mt-3 mt-lg-0">
                            <h5 class="text-light">{{ $item->name }}</h5>
                            <ul class="list-unstyled ps-0 mb-0 mt-3">
                                @foreach($item->childrens as $child)
                                    <li class="mt-2"><a href="{{ $child->link }}" class="text-muted">{{ $child->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="mt-5">
                    <p class="text-muted mt-4 text-center mb-0">2023 © AVNTECH</p>
                </div>
            </div>
        </div>
    </div>
</footer>