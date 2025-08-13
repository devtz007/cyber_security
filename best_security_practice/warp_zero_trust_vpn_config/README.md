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


App/OS -> dnscrypt-proxy → WARP client encrypts packet (WireGuard) → packet sent via main adapter (still encrypted) → ISP sees only encrypted tunnel traffic → reaches Cloudflare WARP server → decrypted → DoH to DNS resolver




[Your App/OS]
      |
      v
[DNSCrypt encrypts DNS query locally]
      |
      v
[Cloudflare DoH client encrypts DNSCrypt packet again with HTTPS]
      |
      v
[WARP client (WireGuard/msquic) encrypts the whole DoH-over-DNSCrypt packet]
      |
      v
[Encrypted packet sent via your main adapter with your public IP]
      |
      v
[Cloudflare WARP server decrypts WireGuard/msquic tunnel]
[Cloudflare DoH server decrypts HTTPS layer]
      |
      v
	  [OpenDNS DNSCrypt decrypt dnscrypt encryption

]
      |
      v
[destination server]
 



 [Your App/OS]
      |
      v
[DNSCrypt encrypts DNS query locally using OpenDNS’s public key]
      |
      v
[Encrypted DNSCrypt query sent over your normal network stack]
      |
      v
[Cloudflare WARP encrypts ALL your outgoing traffic (including the encrypted DNSCrypt query) via WireGuard tunnel]
      |
      v
[Cloudflare WARP server decrypts tunnel, but DNSCrypt payload remains encrypted]
      |
      v
[OpenDNS DNSCrypt resolver decrypts the DNSCrypt query and resolves it]
      |
      v
[Reply sent back encrypted via DNSCrypt, through the tunnel, back to you]