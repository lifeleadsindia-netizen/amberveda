<?php
$zip = new ZipArchive();
$docxPath = 'C:/Users/Lifeleads/.gemini/antigravity/brain/d2473f34-9375-4973-aad8-fb6f4a9ccf07/.user_uploaded/media_1791954609165_8ecf9c18.docx';
if ($zip->open($docxPath) === true) {
    $xml = $zip->getFromName('word/document.xml');
    $doc = new SimpleXMLElement($xml);
    $doc->registerXPathNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
    $paragraphs = $doc->xpath('//w:p');
    echo "Total paragraphs: " . count($paragraphs) . "\n\n";
    foreach ($paragraphs as $idx => $p) {
        $pTexts = [];
        foreach ($p->xpath('.//w:r') as $r) {
            $isBold = count($r->xpath('.//w:b')) > 0;
            foreach ($r->children('http://schemas.openxmlformats.org/wordprocessingml/2006/main') as $child) {
                if ($child->getName() === 'br') {
                    $pTexts[] = ['bold' => false, 'text' => "\n"];
                } elseif ($child->getName() === 't') {
                    $pTexts[] = ['bold' => $isBold, 'text' => (string)$child];
                }
            }
        }
        if (!empty($pTexts)) {
            echo "P" . ($idx + 1) . ":\n";
            foreach ($pTexts as $pt) {
                echo ($pt['bold'] ? "[BOLD]" : "") . $pt['text'] . ($pt['bold'] ? "[/BOLD]" : "");
            }
            echo "\n----------------------------------------\n";
        }
    }
    echo "BR tags count: " . count($doc->xpath('//w:br')) . "\n";
    $zip->close();
} else {
    echo "Could not open zip.\n";
}
