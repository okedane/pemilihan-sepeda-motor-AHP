<x-app>
    <x-slot:title>Data</x-slot:title>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-9">
                    <div class="card shadow-lg border-0 mt-4">
                        <!-- Header dengan gradient merah Honda -->
                        <div class="card-header bg-gradient text-white position-relative overflow-hidden"
                             style="background: linear-gradient(135deg, #CC0000 0%, #E60000 100%); border-radius: 0.5rem 0.5rem 0 0;">
                            <div class="position-absolute top-0 end-0 opacity-10">
                                <i class="fas fa-motorcycle" style="font-size: 4rem; transform: rotate(15deg);"></i>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="bg-white bg-opacity-25 rounded-circle p-2 me-3">
                                    <i class="fas fa-motorcycle text-white" style="font-size: 1.2rem;"></i>
                                </div>
                                <div>
                                    <h4 class="mb-1 fw-bold" style="color: #CC0000;">Input Data Sepeda Motor Honda</h4>
                                    <small style="color: #CC0000; opacity: 0.9;">Sistem Pendukung Keputusan - CV. Sinar Baru</small>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('data.store') }}">
                                @csrf

                                @foreach ($kriterias as $index => $kriteria)
                                    <div class="criteria-section mb-5">
                                        <!-- Header kriteria dengan icon -->
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="criteria-number bg-danger text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                                 style="width: 35px; height: 35px; font-weight: bold;">
                                                {{ $index + 1 }}
                                            </div>
                                            <div>
                                                <h5 class="mb-0 text-dark fw-bold">{{ $kriteria->nama }}</h5>
                                                <small class="text-muted">Pilih salah satu kondisi di bawah ini</small>
                                            </div>
                                        </div>

                                        <!-- Sub kriteria dalam card -->
                                        <div class="row g-3">
                                            @foreach ($kriteria->subKriterias as $sub)
                                                <div class="col-lg-4 col-md-6">
                                                    <label class="card option-card h-100 cursor-pointer border-2 transition-all"
                                                           for="sub_{{ $sub->id }}"
                                                           style="transition: all 0.2s ease; cursor: pointer;">
                                                        <div class="card-body p-3">
                                                            <div class="form-check d-flex align-items-start">
                                                                <input class="form-check-input mt-1 me-3"
                                                                       type="radio"
                                                                       name="sub_kriteria[{{ $kriteria->id }}]"
                                                                       value="{{ $sub->id }}"
                                                                       id="sub_{{ $sub->id }}">
                                                                <div class="flex-grow-1">
                                                                    <div class="fw-semibold text-dark mb-1">{{ $sub->nama }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    @if(!$loop->last)
                                        <hr class="my-4" style="border-top: 2px dashed #dee2e6;">
                                    @endif
                                @endforeach

                                <!-- Submit button dengan loading state -->
                                <div class="text-center mt-5">
                                    <button type="submit"
                                            class="btn btn-danger btn-lg px-5 py-3 shadow-sm fw-bold"
                                            style="border-radius: 25px; min-width: 200px; background: linear-gradient(135deg, #CC0000 0%, #E60000 100%); border: none;"
                                            id="submitBtn">
                                        <i class="fas fa-search me-2"></i>
                                        <span class="submit-text">Proses Analisis</span>
                                        <span class="spinner-border spinner-border-sm ms-2 d-none" id="loadingSpinner"></span>
                                    </button>
                                    <div class="text-muted mt-2">
                                        <small><i class="fas fa-info-circle me-1"></i>Pastikan semua data telah dipilih dengan benar</small>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Progress indicator -->
                    <div class="mt-3 text-center">
                        <small class="text-muted">
                            <i class="fas fa-shield-alt me-1" style="color: #CC0000;"></i>
                            Data Anda aman dan akan diproses menggunakan metode AHP
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .option-card {
            border: 2px solid #e9ecef !important;
            transition: all 0.2s ease;
        }

        .option-card:hover {
            border-color: #CC0000 !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(204, 0, 0, 0.15);
        }

        .form-check-input:checked ~ * .option-card,
        .form-check-input:checked + * {
            border-color: #CC0000 !important;
            background-color: rgba(204, 0, 0, 0.05);
        }

        .criteria-section {
            position: relative;
        }

        .criteria-section:not(:last-child)::after {
            content: '';
            position: absolute;
            bottom: -2.5rem;
            left: 17px;
            width: 2px;
            height: 2rem;
            background: linear-gradient(to bottom, #CC0000, transparent);
        }

        .criteria-number {
            font-size: 0.9rem;
            box-shadow: 0 2px 8px rgba(204, 0, 0, 0.3);
            background: linear-gradient(135deg, #CC0000 0%, #E60000 100%) !important;
        }

        .bg-gradient {
            position: relative;
        }

        .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(204, 0, 0, 0.4);
            background: linear-gradient(135deg, #B30000 0%, #CC0000 100%) !important;
        }

        .form-check-input:checked {
            background-color: #CC0000;
            border-color: #CC0000;
        }

        .form-check-input:focus {
            border-color: #E60000;
            box-shadow: 0 0 0 0.25rem rgba(204, 0, 0, 0.25);
        }

        .transition-all {
            transition: all 0.2s ease;
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 1.5rem;
            }

            .criteria-number {
                width: 30px;
                height: 30px;
                font-size: 0.8rem;
            }

            .btn-lg {
                padding: 0.75rem 2rem;
                font-size: 1rem;
            }
        }
    </style>

    <script>
        // Enhanced form interaction
        document.addEventListener('DOMContentLoaded', function() {
            // Handle option card selection visual feedback
            const radioInputs = document.querySelectorAll('input[type="radio"]');
            const optionCards = document.querySelectorAll('.option-card');

            radioInputs.forEach(radio => {
                radio.addEventListener('change', function() {
                    // Remove active class from all cards in the same group
                    const groupName = this.name;
                    const groupRadios = document.querySelectorAll(`input[name="${groupName}"]`);

                    groupRadios.forEach(groupRadio => {
                        const card = groupRadio.closest('.option-card');
                        card.classList.remove('border-danger', 'bg-light');
                        card.style.borderColor = '#e9ecef';
                        card.style.backgroundColor = '';
                    });

                    // Add active class to selected card
                    const selectedCard = this.closest('.option-card');
                    selectedCard.classList.add('border-danger');
                    selectedCard.style.borderColor = '#CC0000';
                    selectedCard.style.backgroundColor = 'rgba(204, 0, 0, 0.05)';
                });
            });

            // Handle form submission with loading state
            const form = document.querySelector('form');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.querySelector('.submit-text');
            const loadingSpinner = document.getElementById('loadingSpinner');

            form.addEventListener('submit', function(e) {
                submitBtn.disabled = true;
                submitText.textContent = 'Memproses...';
                loadingSpinner.classList.remove('d-none');

                // Optional: Add form validation here
                const requiredGroups = document.querySelectorAll('[name^="sub_kriteria"]');
                const groupNames = [...new Set(Array.from(requiredGroups).map(input => input.name))];

                let allSelected = true;
                groupNames.forEach(groupName => {
                    const groupInputs = document.querySelectorAll(`[name="${groupName}"]`);
                    const isGroupSelected = Array.from(groupInputs).some(input => input.checked);
                    if (!isGroupSelected) {
                        allSelected = false;
                    }
                });

                if (!allSelected) {
                    e.preventDefault();
                    submitBtn.disabled = false;
                    submitText.textContent = 'Proses Analisis';
                    loadingSpinner.classList.add('d-none');

                    alert('Mohon pilih minimal satu data untuk setiap kriteria');
                }
            });

            // Add smooth scrolling for better UX
            optionCards.forEach(card => {
                card.addEventListener('click', function() {
                    // Small delay to ensure radio is selected
                    setTimeout(() => {
                        const nextSection = this.closest('.criteria-section').nextElementSibling;
                        if (nextSection && nextSection.classList.contains('criteria-section')) {
                            nextSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }
                    }, 100);
                });
            });
        });
    </script>
</x-app>
