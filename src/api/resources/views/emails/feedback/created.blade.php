@component('mail::message')
# Новая заявка с сайта

{!! $feedback->name ? '<b>Имя:</b>&nbsp;' . $feedback->name . '<br>': '' !!}
{!! $feedback->email ? '<b>Email:</b>&nbsp;' . $feedback->email . '<br>' : '' !!}
{!! $feedback->phone ? '<b>Телефон:</b>&nbsp;' . $feedback->phone . '<br>': '' !!}
{!! $feedback->text ? '<b>Содержание:</b>&nbsp;' . $feedback->text . '<br>': '' !!}
{!! $feedback->product_name ? '<b>Товар:</b>&nbsp;' . $feedback->product_name . '<br>': '' !!}

@component('mail::button', ['url' => 'https://biolight.com.ua:8888/admin/feedback/' . $feedback->id . '/show'])
Подробнее
@endcomponent


@endcomponent
