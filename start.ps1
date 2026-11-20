$ErrorActionPreference = 'Stop'
$projectRoot = Split-Path -Parent $MyInvocation.MyCommand.Path
$localPhp = Join-Path $projectRoot '.php\php.exe'
$phpExecutable = if (Test-Path -LiteralPath $localPhp) {
    $localPhp
} else {
    $systemPhp = Get-Command php -ErrorAction SilentlyContinue
    if (-not $systemPhp) {
        throw 'PHP 8+ is required. Install PHP or add a project-local runtime at .php\php.exe.'
    }
    $systemPhp.Source
}

Write-Host 'Lite Up Ur Lyfe is running at http://localhost:8000'
Write-Host 'Press Ctrl+C to stop it.'
& $phpExecutable -S localhost:8000 -t $projectRoot
