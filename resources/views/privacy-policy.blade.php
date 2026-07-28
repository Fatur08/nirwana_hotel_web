@extends('layouts.tentang-kami')

@section('content')

    <link href="{{ asset('assets/css/privacy-policy.css') }}" rel="stylesheet">

    <div class="container py-5">

        {{-- ==========================================
        HEADER
        ========================================== --}}
        <div class="text-center mb-5">

            <h1 class="display-5 fw-bold text-primary">
                🔒 Privacy Policy
            </h1>

            <p class="text-muted fs-4">
                NIRWANA GUEST HOUSE
            </p>

            <small class="text-secondary">
                Last Updated : {{ now()->format('d F Y') }}
            </small>

        </div>



        {{-- ==========================================
        INTRODUCTION
        ========================================== --}}
        <div class="card shadow-lg border-0 rounded-4 mb-4">

            <div class="card-body p-4">

                <h3 class="text-primary mb-3">
                    📖 Introduction
                </h3>

                <p class="fs-5 text-justify">

                    Welcome to <strong>NIRWANA GUEST HOUSE</strong>.

                    We value your privacy and are committed to protecting your
                    personal information.

                    This Privacy Policy explains how we collect, use, store,
                    and protect customer information when using our hotel
                    reservation system and WhatsApp notification service.

                </p>

            </div>

        </div>



        {{-- ==========================================
        INFORMATION COLLECTED
        ========================================== --}}
        <div class="card shadow-lg border-0 rounded-4 mb-4">

            <div class="card-body p-4">

                <h3 class="text-primary mb-3">
                    📋 Information We Collect
                </h3>

                <ul class="fs-5">

                    <li>Customer Name</li>

                    <li>WhatsApp Number</li>

                    <li>Reservation Information</li>

                    <li>Check-In Date</li>

                    <li>Check-Out Date</li>

                    <li>Payment Information (if applicable)</li>

                </ul>

            </div>

        </div>



        {{-- ==========================================
        HOW WE USE
        ========================================== --}}
        <div class="card shadow-lg border-0 rounded-4 mb-4">

            <div class="card-body p-4">

                <h3 class="text-primary mb-3">
                    ⚙️ How We Use Your Information
                </h3>

                <ul class="fs-5">

                    <li>Process hotel reservations.</li>

                    <li>Generate booking receipts.</li>

                    <li>Send booking confirmation via WhatsApp.</li>

                    <li>Send payment confirmation.</li>

                    <li>Improve hotel services.</li>

                </ul>

            </div>

        </div>



        {{-- ==========================================
        WHATSAPP
        ========================================== --}}
        <div class="card shadow-lg border-0 rounded-4 mb-4">

            <div class="card-body p-4">

                <h3 class="text-primary mb-3">
                    💬 WhatsApp Notification
                </h3>

                <p class="fs-5">

                    We use the official WhatsApp Business Platform provided
                    by Meta to send reservation confirmations,
                    booking receipts, payment confirmations,
                    and other reservation-related notifications.

                </p>

            </div>

        </div>



        {{-- ==========================================
        SECURITY
        ========================================== --}}
        <div class="card shadow-lg border-0 rounded-4 mb-4">

            <div class="card-body p-4">

                <h3 class="text-primary mb-3">
                    🛡 Data Security
                </h3>

                <p class="fs-5">

                    We implement reasonable technical and organizational
                    measures to protect customer information against
                    unauthorized access, alteration, disclosure,
                    or destruction.

                </p>

            </div>

        </div>



        {{-- ==========================================
        SHARING
        ========================================== --}}
        <div class="card shadow-lg border-0 rounded-4 mb-4">

            <div class="card-body p-4">

                <h3 class="text-primary mb-3">
                    🤝 Information Sharing
                </h3>

                <p class="fs-5">

                    We do not sell, rent,
                    or trade customer personal information.

                    Information is only used to provide hotel
                    reservation services and comply with applicable laws.

                </p>

            </div>

        </div>



        {{-- ==========================================
        CONTACT
        ========================================== --}}
        <div class="card shadow-lg border-0 rounded-4 mb-4">

            <div class="card-body p-4">

                <h3 class="text-primary mb-3">
                    📞 Contact Us
                </h3>

                <div class="fs-5">

                    <p>

                        <strong>Business Name</strong><br>

                        NIRWANA GUEST HOUSE

                    </p>

                    <p>

                        <strong>Website</strong><br>

                        https://nirwanahotelkalianda.com

                    </p>

                    <p>

                        <strong>Email</strong><br>

                        nirwana_email@nirwanahotelkalianda.com

                    </p>

                    <p>

                        <strong>Phone</strong><br>

                        0811 7971 1105

                    </p>

                </div>

            </div>

        </div>



        {{-- ==========================================
        DATA DELETION
        ========================================== --}}
        <div class="card shadow-lg border-0 rounded-4 mb-5">

            <div class="card-body p-4">

                <h3 class="text-primary mb-3">
                    🗑 Data Deletion Request
                </h3>

                <p class="fs-5">

                    If you wish to request deletion of your reservation
                    information stored in our system,
                    please contact us using the email or phone number listed above.

                </p>

            </div>

        </div>



        {{-- ==========================================
        BUTTON
        ========================================== --}}
        <div class="text-center">

            <a href="{{ url('/') }}" class="btn btn-secondary btn-lg px-5">

                ← Back

            </a>

        </div>

    </div>

@endsection