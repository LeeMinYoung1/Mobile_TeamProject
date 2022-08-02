INSERT INTO board(board_code, board_name)
VALUES('testb1', 'test1');

INSERT INTO board(board_code, board_name)
VALUES('testb2', 'test2');




INSERT INTO post(title, date, board_code, post_code)
VALUES('테스트용 게시글.',NOW(),'testb1','1');

INSERT INTO post(title, date, board_code, post_code)
VALUES('맛있는 볶음밥',NOW(),'testb1','2');

INSERT INTO post(title, date, board_code, post_code)
VALUES('쉬운 요리',NOW(),'testb1','3');

INSERT INTO post(title, date, content, board_code, post_code)
VALUES('라면이 좋아', NOW(), '1. 라면을 산다 2. 냄비에 물을 끓인다 3. 스프와 면을 넣는다. 4. 3분뒤에 먹는다','testb1', '4');

INSERT INTO post(title, date, content, board_code, post_code)
VALUES('계란먹자', NOW(), '계란 후라이, 계란 볶음밥, 삶은 계란','testb1', '5');