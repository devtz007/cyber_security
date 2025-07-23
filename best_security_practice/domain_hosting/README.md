# Secure Domain and Hosting Configuration with Cloudflare and GitHub Pages

This document explains the DNS, SSL, and redirect setup for hosting a static website on GitHub Pages with a custom domain managed via Cloudflare.

---

## Overview

- **Domain:** `example.com`
- **Hosting:** GitHub Pages (`example.github.io`)
- **DNS & CDN:** Cloudflare
- **Goal:** Serve site securely over HTTPS with root domain, Redirect to `www`,and end-to-end encryption `Visitor ──HTTPS──▶ Cloudflare Proxy ──HTTP──▶ GitHub Pages Origin Server`

---

## DNS Configuration

| Type  | Name        | Content                 | Proxy Status | Notes                            |
| ----- | ----------- | ----------------------- | ------------ | -------------------------------- |
| A     | example.com | 185.199.108.153         | Proxied      | GitHub Pages IP addresses (4x)   |
| A     | example.com | 185.199.109.153         | Proxied      |                                  |
| A     | example.com | 185.199.110.153         | Proxied      |                                  |
| A     | example.com | 185.199.111.153         | Proxied      |                                  |
| CNAME | www         | example.github.io       | DNS Only     | Points to GitHub Pages, no proxy |
| TXT   | \_dmarc     | `v=DMARC1; p=none; ...` | DNS Only     | Email authentication policy      |

---

## Cloudflare Settings

- **SSL/TLS Mode:** Full or Full (Strict)
  (Ensure GitHub Pages enforces HTTPS for origin connection)
- **Always Use HTTPS:** Enabled
  Redirect all HTTP requests to HTTPS automatically.
- **TLS Version:** 1.1 (Minimum). Also enable 1.3 (recommended for security)
- **Proxy Status:**
  - Root domain (`example.com`) A records: **Proxied**
  - `www` CNAME record: **DNS only** (to avoid SSL mismatch)

---

## Redirect Rules in Cloudflare

### Redirect root domain to www subdomain

| Setting          | Value                          |
| ---------------- | ------------------------------ |
| Rule name        | Redirect from Root to WWW      |
| Matching pattern | `https://example.com/*`        |
| Redirect to URL  | `https://www.example.com/${1}` |
| Status code      | 301 (Permanent Redirect)       |
| Preserve query   | Enabled                        |

---

## GitHub Pages Settings

- **Custom Domain:** `www.example.com` (set in repository settings)
- **Enforce HTTPS:** Enabled (forces HTTPS on GitHub Pages)

---

## Request Flow Summary

```
User enters URL (e.g., example.com or http://example.com)
│
▼
Cloudflare receives the request
│
▼
If request is HTTP:
    Apply "Always Use HTTPS" → Redirect to HTTPS (https://example.com)
    (Request restarts as HTTPS)
│
▼
Cloudflare Redirect Rule:
- If Hostname == example.com
  → Redirect 301 to https://www.example.com/${uri}
  (Request restarts as HTTPS to www.example.com)
│
▼
Cloudflare resolves www.example.com → CNAME → example.github.io
│
▼
Cloudflare serves HTTPS (Universal SSL)
│
▼
Cloudflare fetches from GitHub Pages origin (HTTPS connection)
│
▼
GitHub Pages serves static site for www.example.com
│
▼
Cloudflare forwards content to user
│
▼
User sees secure site at https://www.example.com/...

```

---

## Notes

- Cloudflare Universal SSL automatically manages certificates for your domain.
- DNS only for the CNAME `www` avoids SSL issues with GitHub Pages.
- Proxying the root domain through Cloudflare enables performance and security benefits.
- Enforcing HTTPS on both GitHub and Cloudflare ensures end-to-end encryption.
- Redirects maintain URL paths and query parameters for SEO and user experience.

---

## Troubleshooting

- If you see SSL errors, check Cloudflare SSL mode and ensure GitHub Pages enforces HTTPS.
- DNS changes may take some time to propagate.
- Verify your DNS records do not conflict or duplicate in Cloudflare.
- Use online SSL checkers (e.g., [SSL Labs](https://www.ssllabs.com/ssltest/)) to verify SSL setup.

---

## References

- [GitHub Pages Custom Domain Documentation](https://docs.github.com/en/pages/configuring-a-custom-domain-for-your-github-pages-site)
- [Cloudflare DNS and SSL Documentation](https://developers.cloudflare.com/ssl/)
- [Cloudflare Page Rules & Redirects](https://developers.cloudflare.com/rules/redirect-rules/)

---

_This README was generated to help configure and maintain your static website hosting using GitHub Pages and Cloudflare._

```

```
