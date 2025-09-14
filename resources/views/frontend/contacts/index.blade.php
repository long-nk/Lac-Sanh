@extends('frontend.template.layout')

@section('title', !empty($titleSeo) ? $titleSeo : 'Liên Hệ Lạc Sanh - Hỗ Trợ & Tư Vấn 24/7 Về Đặt Khách Sạn, Resort Và Tour')
@if(@$metaDesc)
    @section('description', @$metaDesc)
@else
    @section('description', 'Thông tin liên hệ. Lạc Sanh - Đơn vị cho thuê khách sạn, resort và dịch vụ tour nghỉ dưỡng uy tín, đảm bảo hàng đầu Việt Nam.')
@endif
@section('image', $imageSeo ?? asset($pageInfo->logo))
@section('content')
    <main class="main mainPage" id="contactPage" role="main">
        <h1 class="d-none">Contact</h1>
        <section class="contact py-4 py-lg-5">
            <div class="container">
                <div class="contact__main d-flex w-100 flex-wrap overflow-hidden">
                    <div class="contact__img d-none d-lg-block col-lg-6">
                        <img src="{{asset($contact->image ?? 'frontend/images/bncontact.jpg')}}" alt="Background liên hệ" class="d-block w-100">
                    </div>
                    <div class="contact__form d-flex align-items-center justify-content-center col-lg-6 p-3 p-lg-5">
                        <form action="{{ route('contact.send_contact') }}" method="POST" class="formContact d-flex w-100 flex-column row-gap-3">
                            @csrf

                            <h2 class="title mb-0 text-center">
                                {{ $contact->title ?? 'Lên kế hoạch cho chuyến đi tiếp theo của bạn' }}
                            </h2>
                            <p class="text mb-0 text-center">
                                {!! !empty(@$contact->content) ? strip_tags(@$contact->content, '<br><strong><em><ul><li><a>') : 'Hãy liên hệ với chúng tôi để được tư vấn du lịch cá nhân hoặc thông tin về du lịch theo nhóm, tất cả các chuyến đi đều được bảo hiểm và an toàn.' !!}
                            </p>
                            <div>
                                <input type="text" class="form-control" name="name" required
                                       value="{{ old('name') }}" placeholder="Nhập họ và tên...">
                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div>
                                <input type="text" class="form-control" name="phone" required
                                       value="{{ old('phone') }}" placeholder="Nhập số điện thoại...">
                                @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div>
                                <input type="text" class="form-control" name="email" required
                                       value="{{ old('email') }}" placeholder="Nhập email...">
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div>
                                <textarea name="message" class="form-control" required placeholder="Lời nhắn...">{{ old('message') }}</textarea>
                                @error('message')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <input type="text" name="robot_check" style="display:none">

                            <button type="submit" class="btnSend" title="Gửi">Gửi</button>
                        </form>
                    </div>
                    <div class="contact__bot d-block col-12">
                        <img src="{{asset($contact->image2 ?? 'frontend/images/bncontact2.jpg')}}" alt="Logo brand" class="d-block w-100">
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

