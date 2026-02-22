@extends('layouts.layoutMaster')

@section('title', 'SMTP Settings')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Settings /</span> SMTP Configuration</h4>

        @include('admin.components.alerts')

        <div class="row">
            <!-- SMTP Settings Form -->
            <div class="col-md-7">
                <div class="card mb-4">
                    <h5 class="card-header">SMTP Server Details</h5>
                    <form action="{{ route('settings.smtp.update') }}" method="POST">
                        @csrf
                        <div class="card-body">

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="mail_mailer" class="form-label">Mail Driver</label>
                                    <select id="mail_mailer" name="mail_mailer"
                                        class="form-select @error('mail_mailer') is-invalid @enderror">
                                        <option value="smtp" {{ (old('mail_mailer', $settings['smtp_mailer']->value ?? 'smtp') == 'smtp') ? 'selected' : '' }}>SMTP</option>
                                        <option value="sendmail" {{ (old('mail_mailer', $settings['smtp_mailer']->value ?? '') == 'sendmail') ? 'selected' : '' }}>Sendmail</option>
                                        <option value="log" {{ (old('mail_mailer', $settings['smtp_mailer']->value ?? '') == 'log') ? 'selected' : '' }}>Log</option>
                                    </select>
                                    @error('mail_mailer')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="mail_encryption" class="form-label">Encryption Protocol</label>
                                    <select id="mail_encryption" name="mail_encryption"
                                        class="form-select @error('mail_encryption') is-invalid @enderror">
                                        <option value="tls" {{ (old('mail_encryption', $settings['smtp_encryption']->value ?? 'tls') == 'tls') ? 'selected' : '' }}>TLS</option>
                                        <option value="ssl" {{ (old('mail_encryption', $settings['smtp_encryption']->value ?? '') == 'ssl') ? 'selected' : '' }}>SSL</option>
                                        <option value="" {{ (old('mail_encryption', $settings['smtp_encryption']->value ?? '') == '') ? 'selected' : '' }}>None</option>
                                    </select>
                                    @error('mail_encryption')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-8">
                                    <label for="mail_host" class="form-label">SMTP Host</label>
                                    <input class="form-control @error('mail_host') is-invalid @enderror" type="text"
                                        id="mail_host" name="mail_host"
                                        value="{{ old('mail_host', $settings['smtp_host']->value ?? 'sandbox.smtp.mailtrap.io') }}"
                                        placeholder="smtp.gmail.com" />
                                    @error('mail_host')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="mail_port" class="form-label">SMTP Port</label>
                                    <input class="form-control @error('mail_port') is-invalid @enderror" type="number"
                                        id="mail_port" name="mail_port"
                                        value="{{ old('mail_port', $settings['smtp_port']->value ?? '2525') }}"
                                        placeholder="587" />
                                    @error('mail_port')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="mail_username" class="form-label">SMTP Username</label>
                                    <input class="form-control @error('mail_username') is-invalid @enderror" type="text"
                                        id="mail_username" name="mail_username"
                                        value="{{ old('mail_username', $settings['smtp_username']->value ?? '') }}" />
                                    @error('mail_username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="mail_password" class="form-label">SMTP Password</label>
                                    <input class="form-control @error('mail_password') is-invalid @enderror" type="password"
                                        id="mail_password" name="mail_password" value=""
                                        placeholder="Leave blank to keep current password" />
                                    @error('mail_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <hr class="my-4 mx-0" />

                                <div class="col-md-6">
                                    <label for="mail_from_address" class="form-label">From Address</label>
                                    <input class="form-control @error('mail_from_address') is-invalid @enderror"
                                        type="email" id="mail_from_address" name="mail_from_address"
                                        value="{{ old('mail_from_address', $settings['smtp_from_address']->value ?? 'hello@example.com') }}"
                                        placeholder="hello@example.com" />
                                    @error('mail_from_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="mail_from_name" class="form-label">From Name</label>
                                    <input class="form-control @error('mail_from_name') is-invalid @enderror" type="text"
                                        id="mail_from_name" name="mail_from_name"
                                        value="{{ old('mail_from_name', $settings['smtp_from_name']->value ?? 'My App') }}"
                                        placeholder="My App" />
                                    @error('mail_from_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Check Email / Send Test config Form -->
            <div class="col-md-5">
                <div class="card mb-4">
                    <h5 class="card-header">Test SMTP Settings</h5>
                    <form action="{{ route('settings.smtp.test') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <p class="mb-4">Send a test email to verify that your SMTP settings are configured correctly.
                                The system will use the currently saved settings (not the form values).</p>

                            <div class="mb-3">
                                <label for="test_email" class="form-label">Recipient Test Email</label>
                                <input class="form-control @error('test_email') is-invalid @enderror" type="email"
                                    id="test_email" name="test_email" value="{{ old('test_email') }}"
                                    placeholder="your-email@example.com" required />
                                @error('test_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div>
                                <button type="submit" class="btn btn-warning">
                                    <i class="ti ti-mail-forward me-1"></i> Send Test Email
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection