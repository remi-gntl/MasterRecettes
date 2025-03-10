<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recettes Gourmandes</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #fffaf0;
            color: #333;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #ff7043;
            padding: 15px 0;
            text-align: center;
            color: white;
            font-size: 1.5em;
            font-weight: bold;
        }
        nav {
            display: flex;
            justify-content: center;
            background: #ff5722;
            padding: 10px;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 1.2em;
        }
        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .recipe-card {
            display: flex;
            background: #ffe0b2;
            margin-bottom: 15px;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .recipe-card:hover {
            transform: scale(1.02);
        }
        .recipe-image {
            width: 120px;
            height: 120px;
            border-radius: 8px;
            object-fit: cover;
            margin-right: 15px;
        }
        .recipe-content {
            flex-grow: 1;
        }
        .recipe-title {
            font-size: 1.5em;
            margin: 0 0 5px;
            color: #d84315;
        }
        .recipe-description {
            font-size: 1em;
            color: #555;
        }
    </style>
</head>
<body>
    <header>Recettes Gourmandes</header>
    <nav>
        <a href="#">Accueil</a>
        <a href="#">Recettes</a>
        <a href="#">À propos</a>
        <a href="#">Contact</a>
    </nav>
    <div class="container">
        <div class="recipe-card">
            <img src="https://source.unsplash.com/150x150/?food" alt="Recette" class="recipe-image">
            <div class="recipe-content">
                <div class="recipe-title">Tarte aux pommes</div>
                <div class="recipe-description">Une délicieuse tarte aux pommes avec une pâte croustillante et un goût sucré irrésistible.</div>
            </div>
        </div>
        <div class="recipe-card">
            <img src="https://source.unsplash.com/150x150/?pasta" alt="Recette" class="recipe-image">
            <div class="recipe-content">
                <div class="recipe-title">Pâtes à la Carbonara</div>
                <div class="recipe-description">Des pâtes crémeuses avec du lard croustillant et du parmesan pour une explosion de saveurs.</div>
            </div>
        </div>
    </div>
</body>
</html>
