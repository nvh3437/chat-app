@php
    $footer = Modules\AvnSetting\Http\Controllers\FooterController::getFooter();
    $footer_socials = Modules\AvnSetting\Http\Controllers\FooterController::getFooterSocial();
    $description = App\Models\GeneralSettings::whereIn('key', ['footer_description_' . Lang::locale()])->first();
    $logo = App\Http\Controllers\Controller::getSetting('logo')->value;
@endphp
<footer class="bg-dark py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="d-flex align-items-start flex-column flex-md-row align-items-md-center">
                    <img src="{{ $logo ? asset('/storage/app/AvnGeneralSettings/' . $logo) : asset('/resources/assets/images/logo.png') }}"
                        width="70" height="70" />
                    <p class="ms-md-3 text-muted mt-4 mt-md-0">{!! $description->value ?? '' !!}</p>
                </div>
                <ul class="social-list list-inline mt-3">
                    @if (isset($footer_socials['social_facebook']) && $footer_socials['social_facebook']['value'])
                        <li class="list-inline-item text-center">
                            <a href="{{ $footer_socials['social_facebook']['value'] }}"
                                class="social-list-item border-primary text-primary"><i
                                    class="mdi mdi-facebook"></i></a>
                        </li>
                    @endif
                    @if (isset($footer_socials['social_google']) && $footer_socials['social_google']['value'])
                        <li class="list-inline-item text-center">
                            <a href="{{ $footer_socials['social_google']['value'] }}"
                                class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                        </li>
                    @endif
                    @if (isset($footer_socials['social_instagram']) && $footer_socials['social_instagram']['value'])
                        <li class="list-inline-item text-center">
                            <a href="{{ $footer_socials['social_instagram']['value'] }}"
                                class="social-list-item border-warning text-warning"><i
                                    class="mdi mdi-instagram"></i></a>
                        </li>
                    @endif
                    @if (isset($footer_socials['social_youtube']) && $footer_socials['social_youtube']['value'])
                        <li class="list-inline-item text-center">
                            <a href="{{ $footer_socials['social_youtube']['value'] }}"
                                class="social-list-item border-danger text-danger"><i class="mdi mdi-youtube"></i></a>
                        </li>
                    @endif
                    @if (isset($footer_socials['social_twitter']) && $footer_socials['social_twitter']['value'])
                        <li class="list-inline-item text-center">
                            <a href="{{ $footer_socials['social_twitter']['value'] }}"
                                class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                        </li>
                    @endif
                    @if (isset($footer_socials['social_linkedin']) && $footer_socials['social_linkedin']['value'])
                        <li class="list-inline-item text-center">
                            <a href="{{ $footer_socials['social_linkedin']['value'] }}"
                                class="social-list-item border-info text-info"><i class="mdi mdi-linkedin"></i></a>
                        </li>
                    @endif
                    @if (isset($footer_socials['social_whatsapp']) && $footer_socials['social_whatsapp']['value'])
                        <li class="list-inline-item text-center">
                            <a href="{{ $footer_socials['social_whatsapp']['value'] }}"
                                class="social-list-item border-success text-success"><i
                                    class="mdi mdi-whatsapp"></i></a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="col-lg-6">
                <div class="row g-3">
                    @foreach ($footer as $item)
                        <div class="col-md-6 col-lg-3">
                            <h5 class="text-light mt-0">
                                @if ($item->vi || $item->en || $item->ja)
                                    {{ $item[Lang::locale()] }}
                                @else
                                    {{ $item->name }}
                                @endif
                            </h5>
                            <ul class="list-unstyled ps-0 mb-0">
                                @foreach ($item->childrens as $child)
                                    <li>
                                        <a href="{{ $child->link }}" class="text-muted">
                                            @if ($child->vi || $child->en || $child->ja)
                                                {{ $child[Lang::locale()] }}
                                            @else
                                                {{ $child->name }}
                                            @endif
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <hr class="border">
        <div class="row flex-center">
            <div class="col-md-6 order-0">
                <p class="mb-0 text-center text-md-start">All rights Reserved ©
                    {{ App\Http\Controllers\Helper::getCompanyName() }}, 2023
                </p>
            </div>
            <div class="col-md-6 order-1">
                <p class="text-muted text-center text-md-end"> Made with&nbsp;
                    <svg class="bi bi-suit-heart-fill" xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                        fill="#FFB30E" viewBox="0 0 16 16">
                        <path
                            d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z">
                        </path>
                    </svg>&nbsp;by&nbsp;<a class="mb-0 fw-bold" href="https://avntech.vn/" target="_blank">AvnTech
                    </a>
                </p>
            </div>
        </div>
    </div>
</footer>
