<!DOCTYPE html>
<html>
<head>
    <title>New Contact Form Submission</title>
</head>
<body>
    <h1>New Contact Form Submission</h1>

    <p><strong>Name:</strong> {{ $contactForm->name }}</p>
    <p><strong>Email:</strong> {{ $contactForm->email }}</p>
    <p><strong>Subject:</strong> {{ $contactForm->subject ?? 'No Subject' }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $contactForm->message }}</p>
    <p><strong>Website:</strong> {{ $contactForm->website }}</p>

    <p>This message was sent from {{ $contactForm->website }}.</p>
</body>
</html>
