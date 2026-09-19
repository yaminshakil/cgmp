@extends('layouts.public')

@section('title', $doctor->name)

@section('content')
<section class="bg-gradient-to-r from-brand-blue-darker via-brand-blue-dark to-brand-blue px-6 py-16 text-center">
    <h1 class="font-serif text-3xl font-bold text-white md:text-4xl">{{ $doctor->name }}</h1>
    @if($doctor->role)
        <p class="mx-auto mt-3 max-w-2xl text-base text-white/85 md:text-lg">{{ $doctor->role }}</p>
    @endif
</section>

<section class="bg-white dark:bg-[#1a1a1a] px-6 py-16">
    <div class="mx-auto max-w-4xl">
        <a href="{{ route('doctors') }}" class="text-sm font-medium text-brand-blue hover:text-brand-red">&larr; All doctors</a>

        <div class="mt-8 grid gap-10 md:grid-cols-[260px_1fr]">
            <div class="flex flex-col items-center">
                <div class="relative h-56 w-56">
                    <div class="avatar-ring absolute -inset-[3px] rounded-full"></div>
                    <div class="avatar-glow relative flex h-56 w-56 items-center justify-center overflow-hidden rounded-full bg-gradient-to-br from-brand-blue-vivid to-brand-blue-dark text-5xl font-bold text-white">
                        @if($doctor->photo)
                            <img src="{{ image_url($doctor->photo) }}" alt="{{ $doctor->name }}" class="h-full w-full object-cover object-top">
                        @else
                            {{ collect(explode(' ', $doctor->name))->map(fn ($w) => mb_substr($w, 0, 1))->implode('') }}
                        @endif
                    </div>
                </div>

                <a href="{{ booking_url() }}" @if(booking_is_external()) target="_blank" rel="noopener" @endif class="btn-lift mt-8 flex w-full items-center justify-center gap-2 rounded-xl bg-brand-red px-8 py-3 text-sm font-semibold text-white shadow-lg hover:bg-brand-red-dark">
                    Book Appointment
                </a>
            </div>

            <div>
                @if($doctor->qualifications)
                    <p class="text-sm font-semibold text-brand-blue">{{ $doctor->qualifications }}</p>
                @endif

                @if($doctor->bio)
                    <p class="mt-4 text-base leading-relaxed text-gray-600 dark:text-white/80">{{ $doctor->bio }}</p>
                @endif

                @if($doctor->years_experience || $doctor->languageList())
                    <div class="mt-6 flex flex-wrap gap-2">
                        @if($doctor->years_experience)
                            <span class="inline-flex items-center rounded-full bg-gray-100 dark:bg-white/10 px-3 py-1 text-xs font-medium text-gray-600 dark:text-white/80">{{ $doctor->years_experience }}</span>
                        @endif
                        @foreach($doctor->languageList() as $language)
                            <span class="inline-flex items-center rounded-full bg-brand-blue-tint dark:bg-white/10 px-3 py-1 text-xs font-medium text-brand-blue">{{ $language }}</span>
                        @endforeach
                    </div>
                @endif

                <h2 class="mt-8 font-serif text-lg font-bold text-[#002B49] dark:text-[#e0e0e0]">Available days</h2>
                <div class="mt-3 flex gap-2">
                    @php $activeDays = $doctor->availability_days ?? []; @endphp
                    @foreach(['sun' => 'Sun', 'mon' => 'Mon', 'tue' => 'Tue', 'wed' => 'Wed', 'thu' => 'Thu', 'fri' => 'Fri'] as $value => $label)
                        <span class="rounded-lg px-3 py-1.5 text-xs font-bold {{ in_array($value, $activeDays) ? 'bg-brand-red text-white' : 'bg-gray-100 dark:bg-white/10 text-gray-300 dark:text-white/30' }}">{{ $label }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
