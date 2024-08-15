<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Mail\ContactFormMail;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_stores_contact_form_data_in_database()
    {
        // Fake the mail sending
        Mail::fake();

        // Data to be submitted
        $formData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'textarea' => 'This is a test message.',
        ];

        // Submit the form
        $response = $this->post(route('contact.submit'), $formData);

        // Assert the data is in the database
        $this->assertDatabaseHas('contacts', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'message' => 'This is a test message.',
        ]);

        $response->assertRedirect()
             ->assertSessionHas('success', 'Your message has been stored successfully!');

    }

    public function it_sends_email()
    {
        // Data to be submitted
        $formData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'textarea' => 'This is a test message.',
        ];

        // Submit the form
        $response = $this->post(route('contact.submit'), $formData);

        // Assert an email was sent
        Mail::assertSent(ContactFormMail::class, function ($mail) use ($formData) {
            return $mail->hasTo('your-email@example.com') &&
                   $mail->data['name'] === $formData['name'] &&
                   $mail->data['email'] === $formData['email'] &&
                   $mail->data['phone'] === $formData['phone'] &&
                   $mail->data['textarea'] === $formData['textarea'];
        });

        // Assert the response redirects back with a success message
        $response->assertRedirect()
                 ->assertSessionHas('success', 'Your message has been sent successfully!');
    }

    /** @test */
    public function it_handles_errors_gracefully()
    {
        // Fake the mail sending to simulate an error
        Mail::fake();

        // Simulate a database error by making the contact model throw an exception
        $this->mock(Contact::class, function ($mock) {
            $mock->shouldReceive('create')->andThrow(new \Exception('Database error'));
        });

        // Data to be submitted
        $formData = [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'phone' => '0987654321',
            'textarea' => 'This is another test message.',
           
        ];

        // Submit the form
        $response = $this->post(route('contact.submit'), $formData);

        // Assert no data is in the database
        $this->assertDatabaseMissing('contacts', [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
        ]);

        // Assert no email was sent
        Mail::assertNothingSent();

        // Assert the response redirects back with an error message
        $response->assertRedirect()
                 ->assertSessionHas('error', 'There was an error processing your request. Please try again later.');
    }
}
