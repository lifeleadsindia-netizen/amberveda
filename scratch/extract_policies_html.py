import os, re, zipfile, xml.etree.ElementTree as ET

policies_dir = r"c:\xampp\htdocs\Amberveda\public\uploads\policies"

def extract_doc_structure(docx_filename):
    path = os.path.join(policies_dir, docx_filename)
    z = zipfile.ZipFile(path)
    tree = ET.fromstring(z.read('word/document.xml'))
    paras = []
    for node in tree.iter('{http://schemas.openxmlformats.org/wordprocessingml/2006/main}p'):
        text = ''.join(node.itertext()).strip()
        if text:
            text = re.sub(r'HYPERLINK\s+"[^"]+"\s*', '', text)
            paras.append(text)
    return paras

files = {
    'privacy': 'privacy-policy.docx',
    'terms': 'terms-of-use.docx',
    'shipping': 'shipping-policy.docx',
    'buyback': 'buyback-refund-policy.docx',
    'cooling': 'cooling-off-policy.docx'
}

data = {}
for k, v in files.items():
    data[k] = extract_doc_structure(v)
    print(f"{k}: {len(data[k])} paragraphs")

with open(r"c:\xampp\htdocs\Amberveda\scratch\extracted_policies.json", "w", encoding="utf-8") as out:
    import json
    json.dump(data, out, indent=2, ensure_ascii=False)
print("Dumped extracted_policies.json successfully")
