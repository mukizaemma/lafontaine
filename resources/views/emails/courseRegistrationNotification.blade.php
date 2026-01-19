<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Course Registration</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background-color: #06BBCC; color: white; padding: 20px; text-align: center; border-radius: 5px 5px 0 0;">
        <h2 style="margin: 0;">New Course Registration</h2>
    </div>
    
    <div style="background-color: #f9f9f9; padding: 20px; border: 1px solid #ddd; border-top: none; border-radius: 0 0 5px 5px;">
        <p style="margin-top: 0;">You have received a new course registration:</p>
        
        <div style="background-color: white; padding: 15px; border-radius: 5px; margin: 15px 0;">
            <p style="margin: 5px 0;"><strong>Course:</strong> {{ $registration->course->title }}</p>
            <p style="margin: 5px 0;"><strong>Category:</strong> {{ $registration->course->category }}</p>
            <p style="margin: 5px 0;"><strong>Level:</strong> {{ $registration->course->level }}</p>
        </div>
        
        <div style="background-color: white; padding: 15px; border-radius: 5px; margin: 15px 0;">
            <p style="margin: 5px 0;"><strong>Student Name:</strong> {{ $registration->full_name }}</p>
            <p style="margin: 5px 0;"><strong>Email:</strong> <a href="mailto:{{ $registration->email }}">{{ $registration->email }}</a></p>
            <p style="margin: 5px 0;"><strong>Phone:</strong> <a href="tel:{{ $registration->phone }}">{{ $registration->phone }}</a></p>
            <p style="margin: 5px 0;"><strong>Country:</strong> {{ $registration->country }}</p>
            <p style="margin: 5px 0;"><strong>Status:</strong> <span style="color: #ff9800; font-weight: bold;">{{ strtoupper($registration->status) }}</span></p>
        </div>
        
        <div style="background-color: white; padding: 15px; border-radius: 5px; margin: 15px 0;">
            <p style="margin: 5px 0 10px 0;"><strong>Motivation:</strong></p>
            <p style="margin: 0; white-space: pre-wrap;">{{ $registration->motivation }}</p>
        </div>
        
        <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #ddd; text-align: center; color: #666; font-size: 12px;">
            <p style="margin: 0;">This registration was submitted from <a href="https://lacfontaine.org" style="color: #06BBCC;">lacfontaine.org</a></p>
            <p style="margin: 5px 0 0 0;">You can reply directly to this email to contact {{ $registration->full_name }}.</p>
        </div>
    </div>
</body>
</html>
