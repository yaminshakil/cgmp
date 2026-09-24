@extends('layouts.public')

@section('title', 'Our Doctors')

@section('content')
<section class="bg-gradient-to-r from-brand-blue-darker via-brand-blue-dark to-brand-blue px-6 py-16 text-center">
    <h1 class="font-serif text-3xl font-bold text-white md:text-4xl">Our Doctors</h1>
    <p class="mx-auto mt-3 max-w-2xl text-base text-white/85 md:text-lg">Meet the experienced, multilingual team dedicated to your care.</p>
</section>

<section class="bg-white dark:bg-[#1a1a1a] px-6 py-24">
    <x-section-title eyebrow="Meet Our Doctors" title="Expert Care from Experienced Practitioners" copy="Our multilingual team of GPs bring a wealth of experience and compassion to every consultation." :nowrap="true" copyClass="text-sm leading-6 sm:text-lg sm:leading-8" />

    @php
        $doctorRoles = collect(['All'])->merge($doctors->pluck('role')->filter()->unique()->values());
        $doctorSearchIndex = $doctors->map(fn ($d) => ['role' => $d->role, 'name' => mb_strtolower($d->name)])->values();
    @endphp

    <div
        class="mx-auto mt-10 max-w-6xl"
        x-data="{
            search: '',
            filter: 'All',
            doctors: @js($doctorSearchIndex),
            matches(role, name) {
                return (this.filter === 'All' || this.filter === role) && (this.search === '' || name.includes(this.search.toLowerCase()));
            },
            get visibleCount() {
                return this.doctors.filter(d => this.matches(d.role, d.name)).length;
            },
        }"
    >
        <div class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400 dark:text-white/40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            <input
                type="text"
                x-model="search"
                placeholder="Search by doctor name..."
                aria-label="Search by doctor name"
                class="w-full rounded-2xl border border-slate-200 dark:border-white/10 bg-white dark:bg-[#1a1a1a] py-3 pl-11 pr-4 text-sm text-ink dark:text-[#e0e0e0] placeholder:text-gray-400 dark:placeholder:text-white/40 focus:border-brand-blue focus:outline-none focus:ring-2 focus:ring-brand-blue/20"
            >
        </div>

        <div class="mt-3 flex gap-2 overflow-x-auto pb-1 [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden" role="group" aria-label="Filter doctors by specialty">
            @foreach($doctorRoles as $roleOption)
                <button
                    type="button"
                    @click="filter = @js($roleOption)"
                    :aria-pressed="(filter === @js($roleOption)).toString()"
                    :class="filter === @js($roleOption) ? 'bg-[#0F2A43] text-white' : 'border border-slate-200 dark:border-white/10 bg-white dark:bg-[#1a1a1a] text-gray-600 dark:text-white/60 hover:border-brand-blue hover:text-brand-blue'"
                    class="shrink-0 whitespace-nowrap rounded-full px-4 py-2 text-sm font-medium transition-colors duration-200"
                >{{ $roleOption }}</button>
            @endforeach
        </div>

        <div class="reveal-stagger mt-8 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach($doctors as $doctor)
                <div x-show="matches(@js($doctor->role), @js(mb_strtolower($doctor->name)))">
                    <x-doctor-card :doctor="$doctor" />
                </div>
            @endforeach
        </div>

        <p class="mt-10 text-center text-sm text-gray-500 dark:text-white/50" x-show="visibleCount === 0">
            No doctors match your search.
        </p>
    </div>
</section>
@endsection
