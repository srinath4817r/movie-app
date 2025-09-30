@extends('layouts.app')

@section('content')

{{-- Add some specific styles for the contact form --}}
<style>
    .contact-container { max-width: 800px; margin: 0 auto; }
    .contact-container h2{color:#ffcc00; font-size: 2.5rem; text-align: center;}
    .contact-container p{text-align: center; color: #ccc; font-size: 1.1rem; line-height: 1.6;}
    .contact-form{display:flex;flex-direction:column;gap:15px;margin-top:40px}
    .form-group{display:flex;flex-direction:column}
    .form-group label{margin-bottom:5px;color:#ffcc00}
    .form-group input,.form-group textarea{background-color:#222;border:1px solid #555;border-radius:5px;padding:12px;color:white;font-size:1rem}
    .form-group input:focus,.form-group textarea:focus{outline:none;border-color:#ffcc00}
    .submit-btn{background-color:#ffcc00;color:#111;border:none;padding:15px;border-radius:5px;font-size:1.1rem;font-weight:700;cursor:pointer;transition:background-color .3s}
    .submit-btn:hover{background-color:#e6b800}
</style>

<div class="contact-container">
    <h2>Contact Us</h2>
    <p>Have a question, comment, or suggestion? We'd love to hear from you. Fill out the form below and we'll get back to you as soon as possible.</p>

    <form action="#" method="POST" class="contact-form">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" name="message" rows="6" required></textarea>
        </div>
        <button type="submit" class="submit-btn">Send Message</button>
    </form>
</div>
@endsection