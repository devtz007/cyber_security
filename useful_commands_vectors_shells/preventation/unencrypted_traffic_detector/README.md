# Raw Data Detector

This command uses `tcpdump` to monitor if any raw data passes through your Linux computer's main network interface.  
It uses Cloudflare WARP VPN as an example. If you use another VPN, update the command with your VPN adapter IP range, VPN IP range, VPN IPv6 range (if available), and VPN network accordingly.  

The main goal is to completely filter out VPN data, internal data, and other unrelated traffic that is expected to be present, so you can identify if any useful unencrypted data is passing through.

The command focuses on capturing only the **raw data** by excluding:

- **Protocol Filters:**
  - ARP
  - Broadcast
  - Multicast

- **Network Filters:**
  - VPN adapter IP range: `172.16.0.0/16`
  - VPN IP range: `162.159.0.0/16`
  - VPN IPv6 range (if available): `2606:4700::/32`

- **Port Filters:**
  - DHCP traffic on UDP ports (any internal communication or unrelated ports): `67` and `68`

---

## Command Usage

Run the following command in your terminal with root privileges:

```bash
sudo tcpdump -i enp7s0 not \(arp or broadcast or multicast\) and not \(net 172.16.0.0/16 or net 162.159.0.0/16 or net 2606:4700::/32\) and not \(udp port 67 or udp port 68\)
