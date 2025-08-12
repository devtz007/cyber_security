+-----------------------+
| Application on device |
| (e.g., browser, app) |
+----------+------------+
|
v
+-----------------------+
| DNS Resolution |
| (via DoH to Cloudflare|
| DNS servers, encrypted) |
+----------+------------+
|
v
+-----------------------+
| Traffic Encryption |
| by WARP Tunnel client |
| (WireGuard or MASQUE) |
+----------+------------+
|
v
+-----------------------+
| Encrypted UDP Packets |
| sent via your network |
| interface (enp7s0) |
+----------+------------+
|
v
+-----------------------+
| Your Router / ISP |
| (sees only encrypted |
| UDP packets to |
| Cloudflare IPs) |
+----------+------------+
|
v
+-----------------------+
| Cloudflare Network |
| decrypts tunnel |
| traffic, forwards to |
| destination internet |
+----------+------------+
|
v
+-----------------------+
| Destination Server |
| (web server, app etc.)|
+-----------------------+

How Dns encryption work
Your App/OS → WARP client encrypts packet (WireGuard) → packet sent via main adapter (still encrypted) → ISP sees only encrypted tunnel traffic → reaches Cloudflare WARP server → decrypted → DoH to DNS resolver
