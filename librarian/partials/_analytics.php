<?php
    //1. Students
    $query ="SELECT COUNT(*) FROM `students` ";
    $stmt = $mysqli->prepare($query);
    $stmt ->execute();
    $stmt->bind_result($std);
    $stmt->fetch();
    $stmt->close();

    //2. Staffs / Librarians
    $query ="SELECT COUNT(*) FROM `librarians` ";
    $stmt = $mysqli->prepare($query);
    $stmt ->execute();
    $stmt->bind_result($libstaff);
    $stmt->fetch();
    $stmt->close();

    //3. Book Categories
    $query ="SELECT COUNT(*) FROM `book_categories` ";
    $stmt = $mysqli->prepare($query);
    $stmt ->execute();
    $stmt->bind_result($bookCats);
    $stmt->fetch();
    $stmt->close();

    //4. Books
    $query ="SELECT SUM(book_copies) FROM `books` ";
    $stmt = $mysqli->prepare($query);
    $stmt ->execute();
    $stmt->bind_result($books);
    $stmt->fetch();
    $stmt->close();
