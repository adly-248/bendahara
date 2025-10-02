<x-app-layout>
    <style>
        /* Container utama */
        .team-container {
            background: linear-gradient(135deg, #f9f9f9, #f0f0f5);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        /* Judul */
        .team-title {
            font-size: 2rem;
            font-weight: 700;
            color: #800000;
            /* maroon */
            margin-bottom: 2rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .team-card img {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #800000;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .team-card img:hover {
            transform: scale(1.08) rotate(-2deg);
            box-shadow: 0 8px 20px rgba(128, 0, 0, 0.4);
        }

        .team-card {
            border-radius: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .team-card:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 12px 30px rgba(128, 0, 0, 0.25);
        }

        .btn-outline-maroon {
            color: #800000;
            border-color: #800000;
            border-radius: 30px;
            transition: all 0.3s ease;
        }

        .btn-outline-maroon:hover {
            background: #800000;
            color: #fff;
        }

	.card p.small {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }
    </style>

    <div class="container mt-5 team-container">
        <h3 class="text-center team-title">Profil Tim Pengembang</h3>

        <div class="row g-4 justify-content-center">

            {{-- Adly --}}
            <div class="col-lg-4 col-md-6">
                <div class="card team-card text-center p-4 h-100">
                    <img src="{{ asset('img/adly3.jpg') }}" alt="Foto Adly Febryan" class="mx-auto mb-3">
                    <h5 class="fw-bold">Adly Febryan</h5>
                    <p class="text-muted mb-1">Fullstack Developer</p>
                    <p class="small">Mengembangkan fitur utama, database, dan keamanan aplikasi.</p>
                    <a href="https://mail.google.com/mail/?view=cm&to=adlyfebryan0@gmail.com" target="_blank"
                        class="btn btn-outline-maroon btn-sm">Hubungi</a>
                </div>
            </div>

            {{-- Mizwar --}}
            <div class="col-lg-4 col-md-6">
                <div class="card team-card text-center p-4 h-100">
                    <img src="{{ asset('img/mizwar.jpg') }}" alt="Foto Mizwar" class="mx-auto mb-3">
                    <h5 class="fw-bold">Mizwar Adiarsa</h5>
                    <p class="text-muted mb-1">UI/UX Designer</p>
                    <p class="small">Mendesain tampilan web agar mudah digunakan, menarik, dan responsif.</p>
                    <a href="https://mail.google.com/mail/?view=cm&to=adiarsamizwar@gmail.com" target="_blank"
                        class="btn btn-outline-maroon btn-sm">Hubungi</a>
                </div>
            </div>

            {{-- Faiza --}}
            <div class="col-lg-4 col-md-6">
                <div class="card team-card text-center p-4 h-100">
                    <img src="{{ asset('img/faiza.jpg') }}" alt="Foto Faiza" class="mx-auto mb-3">
                    <h5 class="fw-bold">Faiza Rahman Ghani</h5>
                    <p class="text-muted mb-1">System Analyst</p>
                    <p class="small">Menganalisis kebutuhan pengguna, merancang alur sistem.</p>
                    <a href="https://mail.google.com/mail/?view=cm&to=faizarahman1703@gmail.com" target="_blank"
                        class="btn btn-outline-maroon btn-sm">Hubungi</a>
                </div>
            </div>

            {{-- ChatGPT --}}
            <div class="col-lg-4 col-md-6">
                <div class="card team-card text-center p-4 h-100">
                    <img src="{{ asset('img/chatgpt.png') }}" alt="ChatGPT" class="mx-auto mb-3" style="width: 100px; height: 100px;">
                    <h5 class="fw-bold">ChatGPT</h5>
                    <p class="text-muted mb-1">AI Assistant</p>
                    <p class="small">Membantu brainstorming, debugging, dan memberikan penjelasan konsep.</p>
                    <a href="https://chatgpt.com/" target="_blank" class="btn btn-outline-maroon btn-sm">Hubungi</a>
                </div>
            </div>

            {{-- Claude --}}
            <div class="col-lg-4 col-md-6">
                <div class="card team-card text-center p-4 h-100">
                    <img src="{{ asset('img/claudeai.png') }}" alt="Claude AI" class="mx-auto mb-3" style="width: 100px; height: 100px;">
                    <h5 class="fw-bold">Claude AI</h5>
                    <p class="text-muted mb-1">AI Collaborator</p>
                    <p class="small">Memberikan ide tambahan, saran, dan perspektif alternatif.</p>
                    <a href="https://claude.ai/" target="_blank" class="btn btn-outline-maroon btn-sm">Hubungi</a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
