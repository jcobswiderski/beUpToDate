USE `beuptodate`;

INSERT INTO `accountType` (`accountType`) VALUES
    ("Standard"), ("Moderator"), ("Admin");

INSERT INTO `account` (`username`, `email`, `password`, `accountTypeID`) VALUES
    ("superuser", "root@root", "123", 3),
    ("robert13", "robcioo@wp.pl", "czarnachmura", 1);

INSERT INTO `note` (`title`, `content`, `authorID`) VALUES
    ('Przepis na serniczek', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam volutpat tortor justo, in suscipit leo laoreet id. Ut finibus, tortor et porta finibus, nulla felis egestas turpis, eu lobortis enim metus quis odio. In consequat ligula nisi, eu commodo ex dapibus quis. Vivamus pretium sollicitudin tristique. Maecenas a aliquam purus. Nam porttitor fringilla ullamcorper. Proin sed ultrices dui. Pellentesque id metus ullamcorper, rhoncus lacus sit amet, pulvinar turpis. Praesent eu interdum enim. Etiam aliquam ornare augue, vel vulputate justo accumsan in. Etiam sodales sem id molestie sagittis. Morbi ultricies semper metus non tincidunt. Etiam non enim ac velit gravida scelerisque. Curabitur rhoncus dolor malesuada rhoncus tempor.', 1),
    ('Kartkówka z matmy!!!', 'Pamiętaj o kartkóweczce!', 2),
    ('PLAN ZAJEC 20.12.2000', 'Matematyka Informatyka Polski', 1);
