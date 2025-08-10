@extends('layouts.navigation')
@section('nav')

<div class="container">
    <h3 class="mb-4">الرسائل الموجهة إليك</h3>

    @if($messages->isEmpty())
        <p>لا توجد رسائل موجهة إليك.</p>
    @else
        <ul class="list-group">
            @foreach($messages as $message)
                <li class="list-group-item">
                    <strong>المرسل: {{ $message->senderName }} ({{ $message->senderEmail }})</strong><br>
                    <strong>الموضوع:</strong> {{ $message->messageSubject }}<br>
                    <p>{{ $message->messageContent }}</p>
                    <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection

