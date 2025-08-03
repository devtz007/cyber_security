<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Comprehensive DOM-Based XSS Lab</title>
</head>
<body>
  <h1>DOM-Based XSS Test Page</h1>

  <h2>#1. Hash Injection via innerHTML</h2>
  <p id="hashOutput"></p>

  <h2>#2. Query Injection via innerHTML</h2>
  <p id="queryOutput"></p>

  <h2>#3. Eval() Injection</h2>
  <p id="evalOutput"></p>

  <h2>#4. setTimeout() Injection</h2>
  <p id="timeoutOutput"></p>

  <h2>#5. setInterval() Injection</h2>
  <p id="intervalOutput"></p>

  <h2>#6. Function() Constructor Injection</h2>
  <p id="functionOutput"></p>

  <h2>#7. document.write() Injection</h2>

  <script>
    // 1. Reflect window.location.hash
    const hash = window.location.hash.slice(1); // remove '#'
    document.getElementById("hashOutput").innerHTML = hash;

    // 2. Reflect location.search param 'q'
    const queryParam = new URLSearchParams(window.location.search).get("q");
    if (queryParam) {
      document.getElementById("queryOutput").innerHTML = queryParam;
    }

    // 3. Eval sink from 'eval' query param
    const evalPayload = new URLSearchParams(window.location.search).get("eval");
    if (evalPayload) {
      document.getElementById("evalOutput").innerText = "Running eval()...";
      eval(evalPayload);
    }

    // 4. setTimeout with dynamic JS code
    const timeoutPayload = new URLSearchParams(window.location.search).get("timeout");
    if (timeoutPayload) {
      document.getElementById("timeoutOutput").innerText = "Running setTimeout...";
      setTimeout(timeoutPayload, 1000);
    }

    // 5. setInterval with dynamic JS code
    const intervalPayload = new URLSearchParams(window.location.search).get("interval");
    if (intervalPayload) {
      document.getElementById("intervalOutput").innerText = "Running setInterval...";
      setInterval(intervalPayload, 3000);
    }

    // 6. Function constructor
    const funcPayload = new URLSearchParams(window.location.search).get("func");
    if (funcPayload) {
      document.getElementById("functionOutput").innerText = "Running Function()...";
      new Function(funcPayload)();
    }

    // 7. document.write() via search param 'doc'
    const docWritePayload = new URLSearchParams(window.location.search).get("doc");
    if (docWritePayload) {
      document.write("<br><strong>document.write():</strong> ");
      document.write(docWritePayload);
    }
  </script>
</body>
</html>
