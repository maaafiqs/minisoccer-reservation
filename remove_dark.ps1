$files = Get-ChildItem -Path "resources/views" -Recurse -Filter "*.blade.php"
foreach ($file in $files) {
    $content = Get-Content $file.FullName -Raw
    $newContent = $content -replace '\s*dark:[^\s"''<]+', ''
    [IO.File]::WriteAllText($file.FullName, $newContent)
}
