<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Lab 3</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .menu { 
            border: 1px solid #ccc; 
            padding: 20px; 
            width: 350px; 
            background-color: #f9f9f9;
            border-radius: 8px; 
        }
        .menu a { 
            display: block; 
            margin-bottom: 15px; 
            text-decoration: none; 
            color: #0056b3; 
            font-size: 18px; 
            font-weight: bold;
        }
        .menu a:hover { text-decoration: underline; color: #003d82; }
        .back-link { font-size: 14px; color: #666; font-weight: normal; }
    </style>
</head>
<body> 
    <div class="menu">
        <h3>Main Menu:</h3>
        
        <a href="stats.php">📊 1. Website Statistics</a>
        
        <a href="search.php">🔍 2. Search Information</a>
        
        <hr>
        <a href="../lab2/index.php" class="back-link">🔙 Back to Data Management (Lab 2)</a>
    </div>
</body>
</html>