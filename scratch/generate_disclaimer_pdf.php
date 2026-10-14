<?php
/**
 * Standalone PDF generator in pure PHP for Disclaimer Clause
 */

class SimplePDF {
    private $pages = [];
    private $currentPage = '';
    private $pageWidth = 595.28; // A4
    private $pageHeight = 841.89;
    private $margin = 54.0;
    private $y;
    private $fontRegularWidths;
    private $fontBoldWidths;
    private $title;

    public function __construct($title = "DISCLAIMER CLAUSE") {
        $this->title = $title;
        $this->initCharWidths();
        $this->newPage();
    }

    private function initCharWidths() {
        $this->fontRegularWidths = [
            ' ' => 278, '!' => 278, '"' => 355, '#' => 556, '$' => 556, '%' => 889, '&' => 667, "'" => 191,
            '(' => 333, ')' => 333, '*' => 389, '+' => 584, ',' => 278, '-' => 333, '.' => 278, '/' => 278,
            '0' => 556, '1' => 556, '2' => 556, '3' => 556, '4' => 556, '5' => 556, '6' => 556, '7' => 556,
            '8' => 556, '9' => 556, ':' => 278, ';' => 278, '<' => 584, '=' => 584, '>' => 584, '?' => 556,
            '@' => 1015, 'A' => 667, 'B' => 667, 'C' => 722, 'D' => 722, 'E' => 667, 'F' => 611, 'G' => 778,
            'H' => 722, 'I' => 278, 'J' => 500, 'K' => 667, 'L' => 556, 'M' => 833, 'N' => 722, 'O' => 778,
            'P' => 667, 'Q' => 778, 'R' => 722, 'S' => 667, 'T' => 611, 'U' => 722, 'V' => 667, 'W' => 944,
            'X' => 667, 'Y' => 667, 'Z' => 611, '[' => 278, '\\' => 278, ']' => 278, '^' => 469, '_' => 556,
            '`' => 333, 'a' => 556, 'b' => 556, 'c' => 500, 'd' => 556, 'e' => 556, 'f' => 278, 'g' => 556,
            'h' => 556, 'i' => 222, 'j' => 222, 'k' => 500, 'l' => 222, 'm' => 833, 'n' => 556, 'o' => 556,
            'p' => 556, 'q' => 556, 'r' => 333, 's' => 500, 't' => 278, 'u' => 556, 'v' => 500, 'w' => 722,
            'x' => 500, 'y' => 500, 'z' => 500, '{' => 334, '|' => 260, '}' => 334, '~' => 584
        ];
        $this->fontBoldWidths = [];
        foreach ($this->fontRegularWidths as $k => $v) {
            $this->fontBoldWidths[$k] = min(1000, (int)($v * 1.08));
        }
    }

    private function getStringWidth($text, $fontSize, $isBold = false) {
        $widths = $isBold ? $this->fontBoldWidths : $this->fontRegularWidths;
        $total = 0;
        $len = strlen($text);
        for ($i = 0; $i < $len; $i++) {
            $char = $text[$i];
            $total += isset($widths[$char]) ? $widths[$char] : 556;
        }
        return ($total / 1000.0) * $fontSize;
    }

    private function escapePdf($text) {
        $replacements = [
            "\xc2\xa0" => ' ', // non-breaking space
            "\xe2\x80\x99" => "'",
            "\xe2\x80\x98" => "'",
            "\xe2\x80\x9c" => '"',
            "\xe2\x80\x9d" => '"',
            "\xe2\x80\x94" => ' -- ',
            "\xe2\x80\x93" => ' - ',
            "\xe2\x80\xa2" => '*',
            "\xe2\x80\xa6" => '...'
        ];
        $text = strtr($text, $replacements);
        $clean = '';
        $len = strlen($text);
        for ($i = 0; $i < $len; $i++) {
            $ord = ord($text[$i]);
            if ($ord >= 32 && $ord < 127) {
                $clean .= $text[$i];
            } else {
                $clean .= ' ';
            }
        }
        return str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], $clean);
    }

    private function newPage() {
        if (!empty($this->currentPage)) {
            $this->pages[] = $this->currentPage;
        }
        $this->currentPage = '';
        $this->y = $this->pageHeight - $this->margin;

        // Top decorative border line
        $this->currentPage .= "q\n0.239 0.420 0.208 rg\n"; // var(--green)
        $this->currentPage .= sprintf("%.2f %.2f %.2f 3.5 re f\n", $this->margin, $this->pageHeight - 25.0, $this->pageWidth - ($this->margin * 2));
        $this->currentPage .= "0.788 0.659 0.298 rg\n"; // var(--gold)
        $this->currentPage .= sprintf("%.2f %.2f %.2f 1.2 re f\nQ\n", $this->margin, $this->pageHeight - 29.0, $this->pageWidth - ($this->margin * 2));

        // Header text
        $this->currentPage .= sprintf(
            "BT\n/F2 8.5 Tf\n0.50 0.40 0.20 rg\n%.2f %.2f Td\n(%s) Tj\nET\n",
            $this->margin, $this->pageHeight - 42.0, "AMBERVEDA WELLNESS PRIVATE LIMITED"
        );
        $this->currentPage .= sprintf(
            "BT\n/F1 8 Tf\n0.45 0.45 0.45 rg\n%.2f %.2f Td\n(%s) Tj\nET\n",
            $this->pageWidth - $this->margin - 110.0, $this->pageHeight - 42.0, "Official Advisory Notice"
        );

        $this->y -= 35;
    }

    private function checkPageSpace($needed) {
        if ($this->y - $needed < $this->margin + 40.0) {
            $this->newPage();
        }
    }

    public function addTitle($titleText) {
        $this->checkPageSpace(60);
        $clean = $this->escapePdf($titleText);
        $fontSize = 18;
        $width = $this->getStringWidth($clean, $fontSize, true);
        $x = ($this->pageWidth - $width) / 2.0;

        $this->currentPage .= sprintf(
            "BT\n/F2 %d Tf\n0.10 0.10 0.10 rg\n%.2f %.2f Td\n(%s) Tj\nET\n",
            $fontSize, $x, $this->y, $clean
        );
        $this->y -= 14;

        // Golden divider
        $divW = 60.0;
        $divX = ($this->pageWidth - $divW) / 2.0;
        $this->currentPage .= sprintf("q\n0.788 0.659 0.298 rg\n%.2f %.2f %.2f 2.0 re f\nQ\n", $divX, $this->y, $divW);
        $this->y -= 26;
    }

    public function addParagraph($text, $lineSpacing = 14.0, $fontSize = 10.0) {
        $usableWidth = $this->pageWidth - ($this->margin * 2);
        $words = preg_split('/\s+/', trim($text));
        $lines = [];
        $currentLine = '';

        foreach ($words as $w) {
            $test = ($currentLine === '') ? $w : $currentLine . ' ' . $w;
            $cleanTest = $this->escapePdf($test);
            if ($this->getStringWidth($cleanTest, $fontSize, false) <= $usableWidth) {
                $currentLine = $test;
            } else {
                if ($currentLine !== '') {
                    $lines[] = $currentLine;
                }
                $currentLine = $w;
            }
        }
        if ($currentLine !== '') {
            $lines[] = $currentLine;
        }

        $needed = count($lines) * $lineSpacing + 12.0;
        $this->checkPageSpace($needed);

        foreach ($lines as $line) {
            $cleanLine = $this->escapePdf($line);
            $this->currentPage .= sprintf(
                "BT\n/F1 %.1f Tf\n0.22 0.22 0.22 rg\n%.2f %.2f Td\n(%s) Tj\nET\n",
                $fontSize, $this->margin, $this->y, $cleanLine
            );
            $this->y -= $lineSpacing;
        }
        $this->y -= 8.0; // paragraph gap
    }

    public function addNoteBox($heading, $text) {
        $this->checkPageSpace(55);
        $boxW = $this->pageWidth - ($this->margin * 2);
        $boxH = 46.0;
        $boxY = $this->y - $boxH + 10.0;

        // Background box
        $this->currentPage .= sprintf(
            "q\n0.98 0.96 0.92 rg\n%.2f %.2f %.2f %.2f re f\n",
            $this->margin, $boxY, $boxW, $boxH
        );
        // Gold left border
        $this->currentPage .= sprintf(
            "0.788 0.659 0.298 rg\n%.2f %.2f 3.5 %.2f re f\nQ\n",
            $this->margin, $boxY, $boxH
        );

        $textX = $this->margin + 12.0;
        $this->currentPage .= sprintf(
            "BT\n/F2 10.5 Tf\n0.239 0.420 0.208 rg\n%.2f %.2f Td\n(%s) Tj\nET\n",
            $textX, $this->y - 6.0, $this->escapePdf($heading)
        );
        $this->currentPage .= sprintf(
            "BT\n/F1 10 Tf\n0.15 0.15 0.15 rg\n%.2f %.2f Td\n(%s) Tj\nET\n",
            $textX, $this->y - 22.0, $this->escapePdf($text)
        );

        $this->y -= ($boxH + 16.0);
    }

    public function render() {
        if (!empty($this->currentPage)) {
            $this->pages[] = $this->currentPage;
            $this->currentPage = '';
        }

        $totalPages = count($this->pages);
        $renderedPages = [];

        foreach ($this->pages as $idx => $page) {
            $pageNum = $idx + 1;
            // Footer
            $page .= sprintf("q\n0.85 0.85 0.85 rg\n%.2f 38.0 %.2f 0.5 re f\nQ\n", $this->margin, $this->pageWidth - ($this->margin * 2));
            $page .= sprintf(
                "BT\n/F1 7.5 Tf\n0.5 0.5 0.5 rg\n%.2f 26.0 Td\n(%s) Tj\nET\n",
                $this->margin, "Amberveda Wellness Pvt Ltd -- Authentic Ayurvedic Healthcare"
            );
            $page .= sprintf(
                "BT\n/F1 8 Tf\n0.4 0.4 0.4 rg\n%.2f 26.0 Td\n(%s) Tj\nET\n",
                $this->pageWidth - $this->margin - 55.0, "Page {$pageNum} of {$totalPages}"
            );
            $renderedPages[] = $page;
        }

        // Assemble PDF objects
        $objects = [];
        $catalogIdx = 1;
        $pagesIdx = 2;
        $fontRegularIdx = 3;
        $fontBoldIdx = 4;
        $currObjId = 5;

        $pageObjIndices = [];
        for ($i = 0; $i < $totalPages; $i++) {
            $pageObjId = $currObjId;
            $contentObjId = $currObjId + 1;
            $pageObjIndices[] = [$pageObjId, $contentObjId];
            $currObjId += 2;
        }

        $objects[] = "<< /Type /Catalog /Pages $pagesIdx 0 R >>";
        $kids = [];
        foreach ($pageObjIndices as $pair) {
            $kids[] = "{$pair[0]} 0 R";
        }
        $objects[] = "<< /Type /Pages /Kids [" . implode(' ', $kids) . "] /Count $totalPages >>";
        $objects[] = "<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>";
        $objects[] = "<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica-Bold >>";

        foreach ($pageObjIndices as $idx => $pair) {
            $pid = $pair[0];
            $cid = $pair[1];
            $contentBytes = $renderedPages[$idx];
            $compressed = gzcompress($contentBytes);

            $objects[] = sprintf(
                "<< /Type /Page /Parent %d 0 R /MediaBox [0 0 %.2f %.2f] /Resources << /Font << /F1 %d 0 R /F2 %d 0 R >> >> /Contents %d 0 R >>",
                $pagesIdx, $this->pageWidth, $this->pageHeight, $fontRegularIdx, $fontBoldIdx, $cid
            );
            $objects[] = sprintf(
                "<< /Length %d /Filter /FlateDecode >>\nstream\n%s\nendstream",
                strlen($compressed), $compressed
            );
        }

        $pdf = "%PDF-1.4\n";
        $offsets = [];
        foreach ($objects as $idx => $obj) {
            $offsets[] = strlen($pdf);
            $objNum = $idx + 1;
            $pdf .= "{$objNum} 0 obj\n{$obj}\nendobj\n";
        }

        $startXref = strlen($pdf);
        $totalObjs = count($objects) + 1;
        $pdf .= "xref\n0 {$totalObjs}\n0000000000 65535 f \n";
        foreach ($offsets as $off) {
            $pdf .= sprintf("%010d 00000 n \n", $off);
        }
        $pdf .= sprintf("trailer\n<< /Size %d /Root %d 0 R >>\nstartxref\n%d\n%%%%EOF\n", $totalObjs, $catalogIdx, $startXref);

        return $pdf;
    }
}

// Convert the DOCX to PDF
$docxPath = 'C:/Users/Lifeleads/.gemini/antigravity/brain/d2473f34-9375-4973-aad8-fb6f4a9ccf07/.user_uploaded/media_1791954609165_8ecf9c18.docx';
$pdfTarget = 'public/uploads/documents/disclaimer-clause.pdf';
$docxTarget = 'public/uploads/documents/DISCLAIMER CLAUSE (2).docx';

// Copy source DOCX
copy($docxPath, $docxTarget);
echo "Copied DOCX to: $docxTarget\n";

$pdf = new SimplePDF("DISCLAIMER CLAUSE");
$pdf->addTitle("DISCLAIMER CLAUSE");

$paragraphs = [
    "Before venturing into our website, it is hereby informed to the general public that our company is engaged into the business of direct selling through its direct seller and retail outlets and in other business activities as stated in the object clauses of memorandum of association of the company and we are also engaging in the marketing or sales of goods directly to the end user consumer on M.R.P/D.P. using word of mouth, publicity, display and / or demonstrations of the goods / products, and /or distribution of pamphlets. We do not indulge in any kind of financial investment or float any investment scheme or chit fund entrepreneurship.",
    "An individual /firm /company who is able to do contract as per the provision of the Indian contact act, 1872 and wish to become direct seller of the company, can apply to be appointed as a direct seller to marketing and selling of company's product in whole of India , in prescribed form through online / manual. There is NO deposit or any charges / enrolment fees / joining fees / renewal charges for becoming a direct seller of the company. Our company shall not be responsible for any promises made by any individual/independent advisor/entity/direct seller/distributor on its behalf accept any promise which is mentioned in the authentic brochure or on website: www.ambervedawellness.com.",
    "We also declare that we have not been given any assurance or promise by the company or its Direct Sellers as to any income on account of the product purchase made by customer. However direct seller will be eligible for sales & marketing incentive depending upon the volume of business done by him / her as per terms and condition of the company.",
    "The information contained in this website is for general information purposes only. the information is provided by Amberveda Wellness Private Limited and while we Endeavour to keep the information up to date and correct, we make no representation or warranties of any kind, express or implied, about the completeness, accuracy, reliability, suitability or availability with respect to the website or the information, products, services, or related graphics contained on the website for any purpose. Any reliance you place on such information is therefore strictly at your own risk.",
    "In no event will we be liable for any loss or damage including without limitation, indirect or consequential loss or damage or any loss or damage whatsoever arising from loss of data or profits arise out of or in correction with the use of this website.",
    "Through this website you are able to link to other websites which are not under the control of Amberveda Wellness Private Limited we have no control over the nature, content and availability of those sites. The inclusion of any links does not necessarily imply a recommendation or endorse the views expressed within them.",
    "Every effort is made to keep the website up and running smoothly. However Amberveda Wellness Private Limited takes no responsibility for and will not be liable for the website being temporarily unavailable due to technical issues beyond our control."
];

foreach ($paragraphs as $p) {
    $pdf->addParagraph($p);
}

$pdf->addNoteBox("NOTE :", "PRODUCT RETURN WITH IN 30 DAYS.                                 Terms and condition apply");

$renderedPdf = $pdf->render();
file_put_contents($pdfTarget, $renderedPdf);
echo "Generated PDF successfully at: $pdfTarget (Size: " . strlen($renderedPdf) . " bytes)\n";
