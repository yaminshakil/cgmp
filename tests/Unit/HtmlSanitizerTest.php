<?php

namespace Tests\Unit;

use App\Support\HtmlSanitizer;
use PHPUnit\Framework\TestCase;

class HtmlSanitizerTest extends TestCase
{
    public function test_it_strips_scripts_handlers_and_unsafe_urls(): void
    {
        $out = HtmlSanitizer::clean(
            '<p onclick="x()">Hi <b>there</b><script>alert(1)</script>'
            ."<a href=\"jav\tascript:alert(1)\">bad</a>"
            .'<a href="https://ok.example" target="_blank">ok</a>'
            .'<img src="x" onerror="alert(1)"><iframe src="//evil"></iframe>'
            .'<span style="color:red">s</span></p>'
        );

        $this->assertStringNotContainsString('script', strtolower($out));
        $this->assertStringNotContainsString('onclick', $out);
        $this->assertStringNotContainsString('onerror', $out);
        $this->assertStringNotContainsString('iframe', $out);
        $this->assertStringNotContainsString('style=', $out);
        $this->assertStringNotContainsString('javascript', strtolower(str_replace("\t", '', $out)));
        $this->assertStringContainsString('<b>there</b>', $out);
        $this->assertStringContainsString('href="https://ok.example"', $out);
        $this->assertStringContainsString('rel="noopener noreferrer"', $out);
    }

    public function test_it_keeps_normal_formatting_and_unicode(): void
    {
        $html = '<h2>Título</h2><ul><li>One</li><li>Two</li></ul><p>Café &amp; more</p>';

        $this->assertSame($html, HtmlSanitizer::clean($html));
    }

    public function test_safe_url(): void
    {
        $this->assertNull(HtmlSanitizer::safeUrl('javascript:alert(1)'));
        $this->assertNull(HtmlSanitizer::safeUrl(" JaVa\nScRiPt:alert(1)"));
        $this->assertNull(HtmlSanitizer::safeUrl('data:text/html;base64,AAAA'));
        $this->assertSame('/contact', HtmlSanitizer::safeUrl('/contact'));
        $this->assertSame('tel:0400000000', HtmlSanitizer::safeUrl('tel:0400000000'));
        $this->assertSame('https://a.example', HtmlSanitizer::safeUrl('https://a.example'));
        $this->assertNull(HtmlSanitizer::safeUrl(''));
    }
}
