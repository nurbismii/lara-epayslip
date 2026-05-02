@php
    $imageFile = basename((string) ($announcement->image ?? ''));
    $thumbnailPath = $imageFile !== '' ? public_path('images/500/' . $imageFile) : null;
    $fullImagePath = $imageFile !== '' ? public_path('images/' . $imageFile) : null;
    $hasThumbnail = $thumbnailPath && file_exists($thumbnailPath);
    $hasFullImage = $fullImagePath && file_exists($fullImagePath);
    $hasImage = $hasThumbnail || $hasFullImage;
    $imageUrl = $hasThumbnail ? asset('images/500/' . $imageFile) : ($hasFullImage ? asset('images/' . $imageFile) : null);
    $fullImageUrl = $hasFullImage ? asset('images/' . $imageFile) : $imageUrl;
    $title = $announcement->judul ?: 'Pengumuman';
    $description = trim(strip_tags((string) $announcement->description));
@endphp

<article class="announcement-card">
    <div class="announcement-media {{ $hasImage ? '' : 'is-missing' }}">
        @if($hasImage)
            <a href="{{ $fullImageUrl }}" target="_blank" rel="noopener">
                <img
                    src="{{ $imageUrl }}"
                    alt="Gambar pengumuman {{ $title }}"
                    loading="lazy"
                    onerror="this.closest('.announcement-media').classList.add('is-missing'); this.parentElement.remove();"
                >
            </a>
        @endif

        <div class="announcement-fallback">
            <i class="mdi mdi-image-off-outline"></i>
            <span>Gambar tidak tersedia</span>
        </div>
    </div>

    <div class="announcement-body">
        <span class="announcement-caption">{{ $announcement->caption ?: 'Informasi perusahaan' }}</span>
        <h5 class="announcement-title">{{ $title }}</h5>
        <p class="announcement-text">
            {{ $description !== '' ? \Illuminate\Support\Str::limit($description, 140) : 'Belum ada deskripsi pengumuman.' }}
        </p>
    </div>
</article>
