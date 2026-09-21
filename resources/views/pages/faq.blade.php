@extends('layouts.public')

@section('title', 'FAQ')

@section('content')
<x-faq-section :faqs="$faqs" />
@endsection
