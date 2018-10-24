# C.A.P. - Clean Architecture Playground
This is a play application to experiment with TDD and Clean Architecture.

In this application we will create and store substitution ciphers. We can then use
these ciphers to encode and decode messages. The user should be able to define a 
new cipher set or view existing cipher sets. CLI and web-based input should be 
supported from the main application.

Eventually the application will be augmented with a logging interface that is 
made available from Dependency Injection.

# Architecture
The architecture of the application is based around the 
[Clean Architecture](http://blog.cleancoder.com/uncle-bob/2012/08/13/the-clean-architecture.html)
by Uncle Bob. A lot of the plumbing of a real framework won't be done in this 
application such as routing, advanced DI setups or a complicated autoloader. All 
of that functionality will be implemented in the index.php file to bootstrap the DI
and get things going.

![Architecture Image][arch-image]

[arch-image]: https://raw.githubusercontent.com/itwasscience/cap/master/CAP-Architecture.svg "Architecture Image"

# Cipher Data Format

For the purposes of this project we will only be concerned with replacing
the 26 english alphabet letters in our substitution cipher.

Ciphers must have an ID, the letter substitutions and a note about them. The 
letters may be substituted for other letters or unicode graphemes. In the 
example data below some random Kanji is used to replace what will be an 
english character set. Kanji was chosen to force us to support more than 
just an ASCII character set.

| id | cipher | notes |
|----|--------|-------|
| 0 | ZEBRASCDFGHIJKLMNOPQTUVWXY | Wikipedia Example |
| 1 | QWERTYUIOPASDFGHJKLZXCVBNM | Decode.fr Example |
| 2 | 恩嫻圀僥鰯狹忰勁摎朴亥模馭稀誣賎堅懺伍网渣閤畏撮請汀 | Random Kanji |
