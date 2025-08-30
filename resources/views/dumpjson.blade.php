
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dumpJSON Dinâmico</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f0f2f5;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #1a237e;
            text-align: center;
            margin-bottom: 30px;
        }
        .json-viewer {
            font-family: 'Courier New', Courier, monospace;
            background-color: #2b2b2b;
            color: #f8f8f2;
            padding: 20px;
            border-radius: 6px;
            overflow-x: auto;
            line-height: 1.5;
        }
        .key { color: #81a2be; } /* light ciano */
        .string { color: #a5c261; } /* light green */
        .number { color: #f99157; } /* orange */
        .boolean { color: #cc6666; } /* red */
        .null { color: #c67623; } /* orange */
        .bracket { color: #d3d3d3; } /* light gray */
        .colon { color: #d3d3d3; } /* light gray */
        .indent { margin-left: 20px; }
    </style>
</head>
<body>

<div class="container">
    <h1>Visualizador de JSON Dinâmico</h1>

    <div class="json-viewer">
        <pre>
@php

    
    function renderJson($data, $indent = 0) {
        $indentColor = ['green', 'red', 'orange', 'green', 'red', 'orange','green', 'red', 'orange','green', 'red', 'orange','green', 'red', 'orange'];
        $html = '';
        if (is_array($data)) {
            $isAssoc = array_keys($data) !== range(0, count($data) - 1);
            $bracket = $isAssoc ? '{' : '[';
            $html .= "<span class='bracket' style='color:{$indentColor[$indent]}'>" . $bracket . "</span>\n";
            $i = 0;
            foreach ($data as $key => $value) {
                $html .= str_repeat(' ', ($indent + 1) * 4);
                if ($isAssoc) {
                    $html .= "<span class='key'>\"" . htmlspecialchars($key) . "\"</span><span class='colon'>: </span>";
                }
                if (is_array($value) || is_object($value)) {
                    $html .= "" . renderJson((array) $value, $indent + 1);
                } else {
                    $html .= renderValue($value);
                }
                $html .= ($i < count($data) - 1) ? "<span class='comma'>,</span>\n" : "\n";
                $i++;
            }
            $html .= str_repeat(' ', $indent * 4) . "<span class='bracket' style='color:{$indentColor[$indent]}'>" . ($isAssoc ? '}' : ']') . "</span>";
        } else {
            $html .= renderValue($data);
        }
        return $html;
    }

    function renderValue($value) {
        $html = '';
        if (is_string($value)) {
            $html .= "<span class='string'>\"" . htmlspecialchars($value) . "\"</span>";
        } elseif (is_numeric($value)) {
            $html .= "<span class='number'>" . $value . "</span>";
        } elseif (is_bool($value)) {
            $html .= "<span class='boolean'>" . ($value ? 'true' : 'false') . "</span>";
        } elseif (is_null($value)) {
            $html .= "<span class='null'>null</span>";
        }
        return $html;
    }

    
@endphp
{!! renderJson($data) !!}
        </pre>
    </div>
</div>

</body>
</html>
