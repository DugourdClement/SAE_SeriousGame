<?php
use PHPUnit\Framework\TestCase;

class ChatbotControllerTest extends TestCase {
    public function testViewChatbotIsUsed()
    {
        $request = new Request('GET', '/mon-site-web');
        $response = new Response();

        $controller = new Presenter();
        $controller->handleRequest($request, $response);

        $this->assertContains('include("ViewChatbot.php")', $response->getContent());
    }
}
