New message from the website contact form

Name:  {{ $m->name }}
Email: {{ $m->email }}
Phone: {{ $m->phone ?: '-' }}

Message:
{{ $m->message }}
