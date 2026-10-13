import json, html, re, os

with open(r"c:\xampp\htdocs\Amberveda\scratch\extracted_policies.json", "r", encoding="utf-8") as f:
    policies = json.load(f)

def clean_bullets(text):
    return re.sub(r'^[•\-\*\u2022\u25cf\u2013\s]+', '', text).strip()

def format_cooling(paras):
    title = paras[0]
    body = paras[1]
    signatory = paras[2] if len(paras) > 2 else ""
    designation = paras[3] if len(paras) > 3 else ""
    
    out = []
    out.append('<div class="policy-doc-header text-center mb-5">')
    out.append('    <span class="sec-label">Statutory Compliance</span>')
    out.append(f'    <h1 class="sec-title mb-3">{html.escape(title)}</h1>')
    out.append('    <div class="sec-div c"></div>')
    out.append('    <p class="text-muted small mt-2">Amberveda Wellness Private Limited • Statutory Consumer & Direct Seller Protection</p>')
    out.append('</div>\n')
    
    out.append('<div class="policy-content-card">')
    out.append('    <div class="policy-lead-box mb-4" style="background: rgba(61, 107, 53, 0.05); border-left: 4px solid var(--green); padding: 26px 30px; border-radius: 12px;">')
    out.append('        <h5 style="color: var(--green); font-weight: 600; font-size: 1.2rem; margin-bottom: 14px;"><i class="fas fa-shield-alt me-2"></i>7-Day Statutory Cooling Off Period</h5>')
    out.append(f'        <p style="font-size: 15px; line-height: 1.85; color: var(--dark); margin-bottom: 0;">{html.escape(body)}</p>')
    out.append('    </div>')
    
    out.append('    <div class="policy-signatory mt-5 pt-4 border-top text-end" style="border-color: rgba(201, 168, 76, 0.25) !important;">')
    if signatory:
        out.append(f'        <p class="mb-1" style="font-weight: 700; color: var(--dark); font-size: 15px;">{html.escape(signatory)}</p>')
    if designation:
        out.append(f'        <p class="text-muted small mb-0">{html.escape(designation)}</p>')
    out.append('    </div>')
    out.append('</div>')
    return '\n'.join(out)

def format_buyback(paras):
    title = paras[0]
    out = []
    out.append('<div class="policy-doc-header text-center mb-5">')
    out.append('    <span class="sec-label">Customer Satisfaction & Return Standards</span>')
    out.append(f'    <h1 class="sec-title mb-3">{html.escape(title)}</h1>')
    out.append('    <div class="sec-div c"></div>')
    out.append('    <p class="text-muted small mt-2">Amberveda Wellness Private Limited • Direct Selling Entity Return & Refund Framework</p>')
    out.append('</div>\n')
    
    out.append('<div class="policy-content-card">')
    
    in_list = False
    for p in paras[1:]:
        clean = p.strip()
        if clean in ['Buyback / Refund Policy:', 'Exchange', 'Refunds', 'Shipping Cost', 'Cancellation of transaction / orders', 'Reference Notes:']:
            if in_list:
                out.append('    </ul>')
                in_list = False
            out.append(f'    <h3 class="policy-section-title mt-4 mb-3">{html.escape(clean)}</h3>')
        elif clean.startswith(('Cancellation by Direct selling entity:', 'Cancellation by the Consumer / Independent Direct Seller:', 'Set-off of any benefits availed by Consumer / Independent Direct Seller:')):
            if in_list:
                out.append('    </ul>')
                in_list = False
            parts = clean.split(':', 1)
            h = parts[0]
            t = parts[1] if len(parts) > 1 else ''
            out.append('    <div class="mb-3 p-3 rounded" style="background: rgba(61, 107, 53, 0.03); border: 1px solid rgba(61, 107, 53, 0.12);">')
            out.append(f'        <h5 style="font-size: 1.05rem; font-weight: 600; color: var(--dark); margin-bottom: 6px;">{html.escape(h)}:</h5>')
            out.append(f'        <p style="font-size: 14.5px; line-height: 1.8; color: var(--text); margin-bottom: 0;">{html.escape(t.strip())}</p>')
            out.append('    </div>')
        elif clean in ['Product Return Form', 'Copy of receipt of goods', 'Products in original packing and marketable condition']:
            if not in_list:
                out.append('    <ul class="policy-list mb-3" style="list-style-type: disc; padding-left: 24px;">')
                in_list = True
            out.append(f'        <li style="font-size: 14.5px; line-height: 1.8; color: var(--text); margin-bottom: 6px;">{html.escape(clean)}</li>')
        elif clean.startswith(('*Marketable', '**Unmarketable')):
            if in_list:
                out.append('    </ul>')
                in_list = False
            out.append(f'    <div class="policy-definition-box mb-3" style="background: rgba(201, 168, 76, 0.08); border-left: 3px solid var(--gold); padding: 12px 18px; border-radius: 6px; font-size: 13.5px; color: var(--text);">')
            out.append(f'        {html.escape(clean)}')
            out.append('    </div>')
        elif clean.startswith(('Period of return for products', 'Condition refers to', 'The Product Return Policy does not apply', 'Total returns cannot exceed', 'SP adjustment of Products', 'If Consumer / Independent Direct Seller return', 'The Consumer / Independent Direct Seller who has returned', 'The return process of a Product')):
            if in_list:
                out.append('    </ul>')
                in_list = False
            out.append('    <div class="policy-note-item d-flex gap-3 mb-2" style="font-size: 14px; line-height: 1.75; color: var(--text);">')
            out.append('        <span style="color: var(--gold-dark); font-weight: 700;">•</span>')
            out.append(f'        <div>{html.escape(clean)}</div>')
            out.append('    </div>')
        else:
            if in_list:
                out.append('    </ul>')
                in_list = False
            out.append(f'    <p>{html.escape(clean)}</p>')
            
    if in_list:
        out.append('    </ul>')
    out.append('</div>')
    return '\n'.join(out)

def format_shipping(paras):
    title = paras[0]
    out = []
    out.append('<div class="policy-doc-header text-center mb-5">')
    out.append('    <span class="sec-label">Logistical Specifications & Delivery Terms</span>')
    out.append(f'    <h1 class="sec-title mb-3">{html.escape(title)}</h1>')
    out.append('    <div class="sec-div c"></div>')
    out.append('    <p class="text-muted small mt-2">Amberveda Wellness Private Limited • Official Logistics, Transit & Fulfillment Charter</p>')
    out.append('</div>\n')
    
    out.append('<div class="policy-content-card">')
    
    in_list = False
    for clean in paras[1:]:
        clean = clean.strip()
        if re.match(r'^[1-6]\.\s+[A-Z\s,-]+$', clean) or clean == 'STATUTORY PREAMBLE & COMPLIANCE ACKNOWLEDGEMENT':
            if in_list:
                out.append('    </ul>')
                in_list = False
            out.append(f'    <h3 class="policy-section-title mt-4 mb-3">{html.escape(clean)}</h3>')
        elif re.match(r'^[1-6]\.[0-9]\.\s+', clean):
            if in_list:
                out.append('    </ul>')
                in_list = False
            out.append(f'    <h5 class="policy-subheading mt-3 mb-2">{html.escape(clean)}</h5>')
        elif clean.startswith(('Digital Orders:', 'Physical Pickups:', 'Fulfillment Centers:', 'Approved Financial Instruments:', 'Standard Operating Hours:', 'On-Site Orders:', 'Digital E-Commerce Orders:', 'Corporate Note:')):
            if in_list:
                out.append('    </ul>')
                in_list = False
            parts = clean.split(':', 1)
            h = parts[0]
            t = parts[1] if len(parts) > 1 else ''
            out.append('    <div class="mb-2 p-2 rounded" style="background: rgba(61, 107, 53, 0.03); border-left: 3px solid var(--green);">')
            out.append(f'        <strong>{html.escape(h)}:</strong> {html.escape(t.strip())}')
            out.append('    </div>')
        elif clean.startswith(('•', '-', '*', '–')):
            subclean = clean_bullets(clean)
            if not in_list:
                out.append('    <ul class="policy-list mb-3" style="list-style-type: disc; padding-left: 24px;">')
                in_list = True
            out.append(f'        <li>{html.escape(subclean)}</li>')
        else:
            if in_list:
                out.append('    </ul>')
                in_list = False
            out.append(f'    <p>{html.escape(clean)}</p>')
            
    if in_list:
        out.append('    </ul>')
    out.append('</div>')
    return '\n'.join(out)

def format_terms(paras):
    title = paras[0]
    out = []
    out.append('<div class="policy-doc-header text-center mb-5">')
    out.append('    <span class="sec-label">Legal Agreement & Terms of Service</span>')
    out.append(f'    <h1 class="sec-title mb-3">{html.escape(title)}</h1>')
    out.append('    <div class="sec-div c"></div>')
    out.append('    <p class="text-muted small mt-2">Amberveda Wellness Private Limited • Information Technology Act Electronic Record</p>')
    out.append('</div>\n')
    
    out.append('<div class="policy-content-card">')
    in_list = False
    for clean in paras[1:]:
        clean = clean.strip()
        # Handle "1. PRELIMINARY DEFINITIONS AND CORPORATE INFORMATIONThe domain name..."
        if clean.startswith("1. PRELIMINARY DEFINITIONS AND CORPORATE INFORMATION"):
            if in_list:
                out.append('    </ul>')
                in_list = False
            body = clean[len("1. PRELIMINARY DEFINITIONS AND CORPORATE INFORMATION"):].strip()
            out.append('    <h3 class="policy-section-title mt-4 mb-3">1. PRELIMINARY DEFINITIONS AND CORPORATE INFORMATION</h3>')
            if body:
                out.append(f'    <p>{html.escape(body)}</p>')
            continue
            
        if re.match(r'^(LEGAL COMPLIANCE|[0-9]{1,2}\.\s+[A-Z\s,]+$)', clean):
            if in_list:
                out.append('    </ul>')
                in_list = False
            out.append(f'    <h3 class="policy-section-title mt-4 mb-3">{html.escape(clean)}</h3>')
        elif re.match(r'^[0-9]{1,2}\.[0-9]\.\s+', clean):
            if in_list:
                out.append('    </ul>')
                in_list = False
            out.append(f'    <h5 class="policy-subheading mt-3 mb-2">{html.escape(clean)}</h5>')
        elif clean.startswith(('•', '-', '*', '–')) or (len(clean) < 180 and clean.endswith((';', '; and', '; or', 'authority.')) and not clean.startswith('The')):
            subclean = clean_bullets(clean)
            if not in_list:
                out.append('    <ul class="policy-list mb-3" style="list-style-type: disc; padding-left: 24px;">')
                in_list = True
            out.append(f'        <li>{html.escape(subclean)}</li>')
        else:
            if in_list:
                out.append('    </ul>')
                in_list = False
            out.append(f'    <p>{html.escape(clean)}</p>')
            
    if in_list:
        out.append('    </ul>')
    out.append('</div>')
    return '\n'.join(out)

def format_privacy(paras):
    title = paras[0]
    out = []
    out.append('<div class="policy-doc-header text-center mb-5">')
    out.append('    <span class="sec-label">Privacy & Data Governance</span>')
    out.append(f'    <h1 class="sec-title mb-3">{html.escape(title)}</h1>')
    out.append('    <div class="sec-div c"></div>')
    out.append('    <p class="text-muted small mt-2">Amberveda Wellness Private Limited • Information Technology Act, 2000 Compliance</p>')
    out.append('</div>\n')
    
    out.append('<div class="policy-content-card">')
    in_list = False
    
    in_grievance_desk = False
    
    for clean in paras[1:]:
        clean = clean.strip()
        # Headings: 1., 2., 3., 4., 5., 6., 7., 8., STATUTORY DECREE
        if re.match(r'^(STATUTORY DECREE|[0-9]{1,2}\.\s+[A-Z\s,&-]+$)', clean):
            if in_list:
                out.append('    </ul>')
                in_list = False
            out.append(f'    <h3 class="policy-section-title mt-4 mb-3">{html.escape(clean)}</h3>')
        elif re.match(r'^[0-9]{1,2}\.[0-9]\.\s+', clean):
            if in_list:
                out.append('    </ul>')
                in_list = False
            out.append(f'    <h5 class="policy-subheading mt-3 mb-2">{html.escape(clean)}</h5>')
        elif clean.startswith(('Grievance Redressal Officer:', 'Official Corporate Email:', 'Contact Direct Hotline:', 'Corporate Finality:')):
            if in_list:
                out.append('    </ul>')
                in_list = False
            parts = clean.split(':', 1)
            h = parts[0]
            t = parts[1] if len(parts) > 1 else ''
            out.append('    <div class="mb-2 p-2 rounded" style="background: rgba(61, 107, 53, 0.04); border-left: 3px solid var(--green);">')
            out.append(f'        <strong>{html.escape(h)}:</strong> <span style="color: var(--dark);">{html.escape(t.strip())}</span>')
            out.append('    </div>')
        elif clean.startswith('Registered Corporate Postal Desk:'):
            if in_list:
                out.append('    </ul>')
                in_list = False
            in_grievance_desk = True
            out.append('    <div class="mb-2 p-3 rounded" style="background: rgba(61, 107, 53, 0.04); border-left: 3px solid var(--green);">')
            out.append('        <strong>Registered Corporate Postal Desk:</strong><br>')
            out.append('        <span style="color: var(--dark);">Amberveda Wellness Private Limited,<br>Corporate Office, B-129, Apex City, Meerut City-250002, Uttar Pradesh, India.</span>')
            out.append('    </div>')
        elif in_grievance_desk and ('Amberveda Wellness Private Limited' in clean or 'Corporate Office, B-129' in clean):
            # Already output inside the postal desk block
            continue
        elif clean.endswith(';') and len(clean) < 140:
            subclean = clean_bullets(clean)
            if not in_list:
                out.append('    <ul class="policy-list mb-3" style="list-style-type: disc; padding-left: 24px;">')
                in_list = True
            out.append(f'        <li>{html.escape(subclean)}</li>')
        else:
            in_grievance_desk = False
            if in_list:
                out.append('    </ul>')
                in_list = False
            out.append(f'    <p>{html.escape(clean)}</p>')
            
    if in_list:
        out.append('    </ul>')
    out.append('</div>')
    return '\n'.join(out)

output_dir = r"c:\xampp\htdocs\Amberveda\resources\views\frontend\policies"
os.makedirs(output_dir, exist_ok=True)

with open(os.path.join(output_dir, "cooling-off.blade.php"), "w", encoding="utf-8") as f:
    f.write(format_cooling(policies['cooling']))

with open(os.path.join(output_dir, "buyback-refund.blade.php"), "w", encoding="utf-8") as f:
    f.write(format_buyback(policies['buyback']))

with open(os.path.join(output_dir, "shipping.blade.php"), "w", encoding="utf-8") as f:
    f.write(format_shipping(policies['shipping']))

with open(os.path.join(output_dir, "terms.blade.php"), "w", encoding="utf-8") as f:
    f.write(format_terms(policies['terms']))

with open(os.path.join(output_dir, "privacy.blade.php"), "w", encoding="utf-8") as f:
    f.write(format_privacy(policies['privacy']))

print("All 5 views updated with high fidelity formatting.")
