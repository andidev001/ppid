import re

with open('resources/views/welcome.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

target = '<h3 class="text-sm font-bold text-white tracking-widest uppercase">Website Wilayah Kota / Kabupaten</h3>'
replacement = '<h3 class="text-sm font-bold text-white tracking-widest uppercase">Link Terkait</h3>'

if target in content:
    content = content.replace(target, replacement)
    print("Replacement success.")
else:
    print("Target not found. Looking with regex...")
    pattern = re.compile(r'<h3[^>]*>Website Wilayah Kota / Kabupaten</h3>')
    if pattern.search(content):
        content = pattern.sub('<h3 class="text-sm font-bold text-white tracking-widest uppercase">Link Terkait</h3>', content)
        print("Regex replacement success.")
    else:
        print("Regex also failed.")

with open('resources/views/welcome.blade.php', 'w', encoding='utf-8') as f:
    f.write(content)
