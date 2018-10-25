# C.A.P. - Clean Architecture Playground
This is a play application to experiment with [TDD](https://en.wikipedia.org/wiki/Test-driven_development) and 
 [Clean Architecture](http://blog.cleancoder.com/uncle-bob/2012/08/13/the-clean-architecture.html)
as presented by Uncle Bob.

In this application we will create and store substitution ciphers. We can then use
these ciphers to encode and decode messages. The user should be able to define a 
new cipher set or view existing cipher sets. CLI and web-based input should be 
supported from the main application.

Eventually the application will be augmented with a logging interface that is 
made available from Dependency Injection.

# FAQ

**Why?**

To learn! It's always a good thing to understand the benefits and caveats of any
particular approach. I feel there's no better way to do that than writing code to 
implement it.

**Why so many classes!?**

This project was an experiment to take things to the extreme degree so every layer
defines all the DTOs and interfaces required to use that layer. This can result in
a class explosion very quickly.

**How many classes and interfaces are we talking anyway?**

Since the business entities can be used by various use cases we can assume some static
number for those that won't change much. We will disregard this in the count.

Roughly in this project you could estimate the best case `UseCase` layer that requires
some external data to have a class count of `(5 * NumberOfUseCases)` and an interface 
count of `(4 * NumberOfUseCases)`. 

The `Adapters` layer then requires at least `(2 * UseCase)` classes. The first class
is the `UseCaseStorageAdapter` that implements the `UseCaseStorageInterface`. This class
converts second class, the `Model` DTO, to something suitable for consumption by the `UseCase`. 

There is also `(1 * UseCase)` interface that must be implemented bby the `FileStorageDriver` 
to populate the `Model` DTO from whatever infrastructure data store there is.

| UseCases |  Class Count | Interface Count | Total Files |
|----------|--------------|-----------------|-------------|
| 1 | 7 | 5 | 12 |
| 5 | 35 | 25 | 60 |
| 20 | 140 | 100 | 240 |
| 100 | 700 | 500 | 1200 |

This does not include entity objects or any other project objects such as tests.

**Can we break down why there's so many?**

For any `UseCase` that needs some information from a database must define at least:
 * `UseCase` Implementation Class
 * `UseCaseInputInterface` from "Front-End" boundary
 * `UseCaseInput` Object used by the `InputInterface`
 * `UseCaseOutputInterface` to be implemented by the "Front-End" class
 * `UseCaseOutput` Object used by the `OutputInterface`
 * `UseCaseStorageInterface` to be implemented by the data store class

That list does not include any validation classes that might be required to ensure those
`UseCaseInput` objects don't have something wrong with them.

Things get interesting at how this affects other layers such as the `StorageAdater`.
For example the `StorageAdapter` may have many class implementations such as:
 * `class EncodeMessageUseCaseStorageAdapter implements EncodeMessageStorageInterface`
 * `class DecodeMessageUseCaseStorageAdapter implements DeocdeMessageStorageInterface`

Alternatively it would be possible to do the following:

<pre>
class StorageAdapter implements EncodeMesssageStorageInterface, DecodeMessageStorageInterface
</pre>

This has the caveat that you must be very careful in naming methods between interfaces 
in each `UseCase` if the functionality is different. I don't feel this is a good idea.


**Could some of this be made simpler without losing the benefits of decoupling?**

To some degree. For example a generic `StorageAdapterInterface` that implemented many 
methods (such as `findCipherById` and `findSomeOtherThingById`) could easily be injected 
into each `UseCase` object instead of a requiring a specific implementation for every 
use case. This dramatically reduces the number of `StorageAdapterInterface` required but
does require the `UseCase` to know about the format of the object coming back instead of
explicitly defining the `UseCaseStorageInterface`. This is what I've seen in a lot of 
projects and is more akin to the hexagon architecture. 


**Where are the code comments?**

I made the deliberate choice to not document anything inside of the code just to
see how that affected my ability to navigate around in this pet project. I've found
the type system in PHP-7 has made things easier since the `@param` doc blocks can be 
redundant if good names are chosen.

<pre>
/**
 * High Fives a UserRecord object.
 *
 * @param UserRecord $targettedUser The requested UserRecord object to be acted upon
 */
 public function giveHighFive(UserRecord $targettedUser) : void;
</pre>

Was that DocBlock really required? I'm still debating this one.


# Architecture
The architecture of the application is based around the 
[Clean Architecture](http://blog.cleancoder.com/uncle-bob/2012/08/13/the-clean-architecture.html)
by Uncle Bob. A lot of the plumbing of a real framework won't be done in this 
application such as routing, advanced DI setups or a complicated autoloader. All 
of that functionality will be implemented in the index.php file to bootstrap the DI
and get things going.

![Architecture Image][arch-image]

[arch-image]: https://user-images.githubusercontent.com/26612459/47468122-9ac70c80-d7c7-11e8-936e-504d70fe33ae.png "Architecture Image"

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
