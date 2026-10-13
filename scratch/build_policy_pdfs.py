import os, re, zlib, zipfile, xml.etree.ElementTree as ET

# Standard Helvetica character widths in 1/1000 of em
CHAR_WIDTHS_REGULAR = {
    ' ': 278, '!': 278, '"': 355, '#': 556, '$': 556, '%': 889, '&': 667, "'": 191,
    '(': 333, ')': 333, '*': 389, '+': 584, ',': 278, '-': 333, '.': 278, '/': 278,
    '0': 556, '1': 556, '2': 556, '3': 556, '4': 556, '5': 556, '6': 556, '7': 556,
    '8': 556, '9': 556, ':': 278, ';': 278, '<': 584, '=': 584, '>': 584, '?': 556,
    '@': 1015, 'A': 667, 'B': 667, 'C': 722, 'D': 722, 'E': 667, 'F': 611, 'G': 778,
    'H': 722, 'I': 278, 'J': 500, 'K': 667, 'L': 556, 'M': 833, 'N': 722, 'O': 778,
    'P': 667, 'Q': 778, 'R': 722, 'S': 667, 'T': 611, 'U': 722, 'V': 667, 'W': 944,
    'X': 667, 'Y': 667, 'Z': 611, '[': 278, '\\': 278, ']': 278, '^': 469, '_': 556,
    '`': 333, 'a': 556, 'b': 556, 'c': 500, 'd': 556, 'e': 556, 'f': 278, 'g': 556,
    'h': 556, 'i': 222, 'j': 222, 'k': 500, 'l': 222, 'm': 833, 'n': 556, 'o': 556,
    'p': 556, 'q': 556, 'r': 333, 's': 500, 't': 278, 'u': 556, 'v': 500, 'w': 722,
    'x': 500, 'y': 500, 'z': 500, '{': 334, '|': 260, '}': 334, '~': 584
}

CHAR_WIDTHS_BOLD = {k: min(1000, int(v * 1.08)) for k, v in CHAR_WIDTHS_REGULAR.items()}

def get_string_width(text, font_size, is_bold=False):
    widths = CHAR_WIDTHS_BOLD if is_bold else CHAR_WIDTHS_REGULAR
    total = 0
    for char in text:
        total += widths.get(char, 556)
    return (total / 1000.0) * font_size

def escape_pdf(text):
    # Map common unicode to ascii
    replacements = {
        '\u2019': "'", '\u2018': "'", '\u201c': '"', '\u201d': '"',
        '\u2014': " -- ", '\u2013': " - ", '\u2022': "*", '\u2026': "...",
        '\xa0': " ", '\u200b': "", '\ufffd': ""
    }
    for k, v in replacements.items():
        text = text.replace(k, v)
    # Filter to printable ASCII
    text = ''.join(c if (32 <= ord(c) < 127) else ' ' for c in text)
    return text.replace('\\', '\\\\').replace('(', '\\(').replace(')', '\\)')

def wrap_text(text, max_width, font_size, is_bold=False):
    words = text.split()
    if not words:
        return []
    lines = []
    current_line = []
    
    for word in words:
        test_line = ' '.join(current_line + [word])
        w = get_string_width(test_line, font_size, is_bold)
        if w <= max_width:
            current_line.append(word)
        else:
            if current_line:
                lines.append(' '.join(current_line))
                current_line = [word]
            else:
                # Word itself is wider than max_width, force wrap
                lines.append(word)
                current_line = []
    if current_line:
        lines.append(' '.join(current_line))
    return lines

class PDFDocument:
    def __init__(self, doc_title):
        self.doc_title = doc_title
        self.page_width = 595.28  # A4
        self.page_height = 841.89 # A4
        self.margin_x = 54.0      # 0.75 in
        self.margin_top = 54.0
        self.margin_bottom = 54.0
        self.printable_width = self.page_width - (2 * self.margin_x)
        self.pages = []
        self.current_stream = []
        self.cursor_y = self.page_height - self.margin_top
        self.new_page()

    def new_page(self):
        if self.current_stream:
            self.pages.append(self.current_stream)
            self.current_stream = []
        self.cursor_y = self.page_height - self.margin_top - 40 # reserve header space

    def check_space(self, height_needed):
        if self.cursor_y - height_needed < (self.margin_bottom + 30):
            self.new_page()

    def add_title(self, title_text):
        self.check_space(50)
        lines = wrap_text(title_text, self.printable_width, 15, is_bold=True)
        for line in lines:
            # Gold color for title
            self.current_stream.append(f"0.12 0.28 0.14 rg") # Forest green
            self.current_stream.append("BT /F2 15 Tf")
            self.current_stream.append(f"{self.margin_x} {self.cursor_y} Td ({escape_pdf(line)}) Tj ET")
            self.cursor_y -= 22
        # Accent gold bar under title
        bar_y = self.cursor_y + 10
        self.current_stream.append(f"0.788 0.659 0.298 RG 2 w {self.margin_x} {bar_y} m {self.margin_x + self.printable_width} {bar_y} l S")
        self.cursor_y -= 14

    def add_heading(self, heading_text):
        self.check_space(34)
        lines = wrap_text(heading_text, self.printable_width, 11, is_bold=True)
        for line in lines:
            self.current_stream.append(f"0.15 0.32 0.16 rg")
            self.current_stream.append("BT /F2 11 Tf")
            self.current_stream.append(f"{self.margin_x} {self.cursor_y} Td ({escape_pdf(line)}) Tj ET")
            self.cursor_y -= 16
        self.cursor_y -= 4

    def add_subheading(self, subhead_text):
        self.check_space(26)
        lines = wrap_text(subhead_text, self.printable_width, 10, is_bold=True)
        for line in lines:
            self.current_stream.append(f"0.25 0.25 0.25 rg")
            self.current_stream.append("BT /F2 10 Tf")
            self.current_stream.append(f"{self.margin_x} {self.cursor_y} Td ({escape_pdf(line)}) Tj ET")
            self.cursor_y -= 14
        self.cursor_y -= 2

    def add_paragraph(self, p_text, indent=0, is_note=False):
        width = self.printable_width - indent
        lines = wrap_text(p_text, width, 9.5, is_bold=False)
        self.check_space(len(lines) * 13.5 + 8)
        
        start_x = self.margin_x + indent
        for line in lines:
            if is_note:
                self.current_stream.append("0.35 0.35 0.35 rg")
            else:
                self.current_stream.append("0.18 0.18 0.18 rg")
            self.current_stream.append("BT /F1 9.5 Tf")
            self.current_stream.append(f"{start_x} {self.cursor_y} Td ({escape_pdf(line)}) Tj ET")
            self.cursor_y -= 13.5
        self.cursor_y -= 5

    def add_bullet(self, b_text):
        width = self.printable_width - 16
        lines = wrap_text(b_text, width, 9.5, is_bold=False)
        self.check_space(len(lines) * 13.5 + 4)
        
        # bullet dot
        bullet_x = self.margin_x + 4
        text_x = self.margin_x + 16
        
        self.current_stream.append("0.788 0.659 0.298 rg") # Gold bullet
        self.current_stream.append("BT /F2 9.5 Tf")
        self.current_stream.append(f"{bullet_x} {self.cursor_y} Td (*) Tj ET")
        
        for line in lines:
            self.current_stream.append("0.18 0.18 0.18 rg")
            self.current_stream.append("BT /F1 9.5 Tf")
            self.current_stream.append(f"{text_x} {self.cursor_y} Td ({escape_pdf(line)}) Tj ET")
            self.cursor_y -= 13.5
        self.cursor_y -= 4

    def build_pdf(self):
        if self.current_stream:
            self.pages.append(self.current_stream)
        total_pages = len(self.pages)
        
        rendered_pages = []
        for p_idx, page_cmds in enumerate(self.pages):
            p_num = p_idx + 1
            stream = []
            
            # --- Header ---
            # Brand title
            stream.append("0.12 0.28 0.14 rg")
            stream.append("BT /F2 8.5 Tf")
            stream.append(f"{self.margin_x} {self.page_height - 32} Td (AMBERVEDA WELLNESS PRIVATE LIMITED) Tj ET")
            
            # Right header: policy name
            doc_label = self.doc_title[:45]
            stream.append("0.5 0.5 0.5 rg")
            stream.append("BT /F1 8 Tf")
            stream.append(f"{self.page_width - self.margin_x - 180} {self.page_height - 32} Td ({escape_pdf(doc_label)}) Tj ET")
            
            # Header line
            stream.append(f"0.85 0.85 0.85 RG 0.5 w {self.margin_x} {self.page_height - 38} m {self.page_width - self.margin_x} {self.page_height - 38} l S")
            
            # Page content
            stream.extend(page_cmds)
            
            # --- Footer ---
            stream.append(f"0.85 0.85 0.85 RG 0.5 w {self.margin_x} 38 m {self.page_width - self.margin_x} 38 l S")
            
            # Left footer
            stream.append("0.5 0.5 0.5 rg")
            stream.append("BT /F1 8 Tf")
            stream.append(f"{self.margin_x} 26 Td (www.ambervedawellness.com  |  Official Statutory Policy) Tj ET")
            
            # Right footer
            stream.append(f"{self.page_width - self.margin_x - 65} 26 Td (Page {p_num} of {total_pages}) Tj ET")
            
            rendered_pages.append('\n'.join(stream).encode('latin1', 'replace'))
            
        # Build PDF Structure
        objects = []
        page_obj_indices = []
        
        # 1: Catalog
        catalog_idx = 1
        # 2: Pages
        pages_idx = 2
        # Fonts
        font_regular_idx = 3
        font_bold_idx = 4
        
        curr_obj_id = 5
        
        for i in range(total_pages):
            page_obj_id = curr_obj_id
            content_obj_id = curr_obj_id + 1
            page_obj_indices.append((page_obj_id, content_obj_id))
            curr_obj_id += 2
            
        objects.append(f"<< /Type /Catalog /Pages {pages_idx} 0 R >>".encode())
        kids = " ".join([f"{pid} 0 R" for pid, cid in page_obj_indices])
        objects.append(f"<< /Type /Pages /Kids [{kids}] /Count {total_pages} >>".encode())
        objects.append(b"<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>")
        objects.append(b"<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica-Bold >>")
        
        for (pid, cid), page_bytes in zip(page_obj_indices, rendered_pages):
            # Page object
            page_def = f"<< /Type /Page /Parent {pages_idx} 0 R /MediaBox [0 0 {self.page_width:.2f} {self.page_height:.2f}] /Resources << /Font << /F1 {font_regular_idx} 0 R /F2 {font_bold_idx} 0 R >> >> /Contents {cid} 0 R >>".encode()
            objects.append(page_def)
            
            # Content stream
            compressed = zlib.compress(page_bytes)
            stream_def = f"<< /Length {len(compressed)} /Filter /FlateDecode >>\nstream\n".encode() + compressed + b"\nendstream"
            objects.append(stream_def)
            
        pdf = b"%PDF-1.4\n"
        offsets = []
        for idx, obj in enumerate(objects):
            offsets.append(len(pdf))
            pdf += f"{idx+1} 0 obj\n".encode() + obj + b"\nendobj\n"
            
        startxref = len(pdf)
        pdf += f"xref\n0 {len(objects)+1}\n0000000000 65535 f \n".encode()
        for off in offsets:
            pdf += f"{off:010d} 00000 n \n".encode()
        pdf += f"trailer\n<< /Size {len(objects)+1} /Root {catalog_idx} 0 R >>\nstartxref\n{startxref}\n%%EOF\n".encode()
        return pdf

def parse_and_convert(docx_path, pdf_path, default_title):
    z = zipfile.ZipFile(docx_path)
    tree = ET.fromstring(z.read('word/document.xml'))
    paras = []
    for node in tree.iter('{http://schemas.openxmlformats.org/wordprocessingml/2006/main}p'):
        text = ''.join(node.itertext()).strip()
        if text:
            # Clean up artifacts like 'HYPERLINK "..."'
            text = re.sub(r'HYPERLINK\s+"[^"]+"\s*', '', text)
            paras.append(text)
            
    if not paras:
        print(f"Warning: No paragraphs in {docx_path}")
        return
        
    doc = PDFDocument(default_title)
    
    first = True
    for p in paras:
        upper = p.upper()
        if first:
            doc.add_title(p)
            first = False
            continue
            
        # Check if heading
        if re.match(r'^(STATUTORY|LEGAL|BUY\s*BACK|COOLING|SHIPPING|PRIVACY|WEBSITE|TERMS|REFUND|EXCHANGE|\d+\.|\([A-Za-z0-9]+\))', p) and len(p) < 80:
            doc.add_heading(p)
        elif p.startswith(('*', '-', '•')) or re.match(r'^\d+\.\d+', p):
            doc.add_bullet(p)
        elif len(p) < 50 and ('Officer' in p or 'Dated' in p or 'Director' in p):
            doc.add_subheading(p)
        else:
            doc.add_paragraph(p)
            
    pdf_bytes = doc.build_pdf()
    with open(pdf_path, 'wb') as f:
        f.write(pdf_bytes)
    print(f"Generated {pdf_path} ({len(pdf_bytes)} bytes, {len(doc.pages)} pages)")

if __name__ == '__main__':
    policies_dir = r"c:\xampp\htdocs\Amberveda\public\uploads\policies"
    tasks = [
        ("privacy-policy.docx", "privacy-policy.pdf", "Privacy Policy & Data Protection Charter"),
        ("terms-of-use.docx", "website-terms-of-use.pdf", "Website Terms of Use"),
        ("shipping-policy.docx", "shipping-policy.pdf", "Shipping Policy"),
        ("buyback-refund-policy.docx", "buyback-refund-policy.pdf", "Buyback / Refund / Cancellation Policy"),
        ("cooling-off-policy.docx", "cooling-off-policy.pdf", "Cooling Off Policy")
    ]
    for docx_name, pdf_name, title in tasks:
        d_path = os.path.join(policies_dir, docx_name)
        p_path = os.path.join(policies_dir, pdf_name)
        if os.path.exists(d_path):
            parse_and_convert(d_path, p_path, title)
        else:
            print(f"Not found: {d_path}")
