<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8">
    <title>Шинэ бүлэг нэмэх</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f3f4f6;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 420px;
            background: white;
            padding: 35px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.12);
        }

        h1 {
            text-align: center;
            color: #1f2937;
            margin-bottom: 30px;
            font-size: 26px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #374151;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 16px;
            outline: none;
        }

        input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 5px rgba(37,99,235,0.3);
        }

        .save-btn {
            width: 100%;
            margin-top: 25px;
            padding: 12px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .save-btn:hover {
            background: #1d4ed8;
        }

        .back-btn {
            display: block;
            text-align: center;
            margin-top: 18px;
            padding: 12px;
            background: #6b7280;
            color: white;
            border-radius: 10px;
            text-decoration: none;
            transition: 0.3s;
        }

        .back-btn:hover {
            background: #4b5563;
        }

    </style>

</head>

<body>


<div class="container">

    <h1>📂 Шинэ бүлэг нэмэх</h1>


    <form action="/categories" method="POST">

        @csrf


        <label>
            Бүлгийн нэр
        </label>


        <input 
            type="text"
            name="name"
            placeholder="Бүлгийн нэр оруулна уу..."
            required>


        <button type="submit" class="save-btn">
            💾 Хадгалах
        </button>


    </form>



    <a href="{{ route('products.create') }}" class="back-btn">
        ← Шинэ бараа руу буцах
    </a>


</div>


</body>
</html>