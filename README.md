Object oriented representation of SQL queries.
==============================================

This library does not generate any SQL, instead it provides an object oriented representation of SQL queries, allowing the structure of queries to be defined by the developer whilst gaining the benefits of inheritance.

When a PHP application reaches scale, it is often the database that is the performance bottleneck. When queries are generated on behalf of the developer, they are often difficult to optimise because control is lost. With SqlBuilder, the developer is always in control of the raw SQL.

***

<a href="https://circleci.com/gh/PhpGt/SqlBuilder" target="_blank">
	<img src="https://badge.status.php.gt/sqlbuilder-build.svg" alt="Build status" />
</a>
<a href="https://scrutinizer-ci.com/g/PhpGt/SqlBuilder" target="_blank">
	<img src="https://badge.status.php.gt/sqlbuilder-quality.svg" alt="Code quality" />
</a>
<a href="https://scrutinizer-ci.com/g/PhpGt/SqlBuilder" target="_blank">
	<img src="https://badge.status.php.gt/sqlbuilder-coverage.svg" alt="Code coverage" />
</a>
<a href="https://packagist.org/packages/PhpGt/SqlBuilder" target="_blank">
	<img src="https://badge.status.php.gt/sqlbuilder-version.svg" alt="Current version" />
</a>
<a href="http://www.php.gt/dom" target="_blank">
	<img src="https://badge.status.php.gt/sqlbuilder-docs.svg" alt="PHP.Gt/SqlBuilder documentation" />
</a>

Example usage: selecting from the `student` table
--------------------------------------------------

Imagine a typical database application with a `student` table used to store details of each student. A basic select might look something like this:

```sql
select
	id,
	forename,
	surname,
	dateOfBirth
from
	student
```

The above query will return a list of all students. The problem here is that when you come to need to select from the student table again, this time with some constraints such as an age range or ordered by surname, the whole query will need to be repeated and only a small portion of the original query will need to be changed.

Instead, the following class can be used to represent the above query:

```php
class StudentSelect extends SelectBuilder {
	public function select():array {
		return [
			"id",
			"forename",
			"surname",
			"dateOfBirth",
		];
	}
	
	public function from():string {
		return "student";
	}
}
```

The `__toString` method of the above class will produce identical SQL to the original query.

Now, to write another query that returns students of a certain age:

```php
class StudentSelectByAge extends StudentSelect {
	public function where():array {
		return [
			"year(now()) - year(dateOfBirth) = :age",
		];
	}
}
```


Limitations of plain SQL
------------------------

The only tools provided by plain SQL that can be used to write [DRY code][dry] are [views][view] and [stored procedures][stored-procedure], both of which have their own set of limitations when writing clean and maintainable code.

The solution provided by this library is to break down an SQL query into its different sections, represented by a PHP class which can be extended by other classes, while still retaining the plain SQL that is being represented.

SQL compatibility
-----------------

This library does not provide any SQL processing capabilities by design. Any driver-specific SQL used will not be compatible with other drivers.

[dry]: https://en.wikipedia.org/wiki/Don%27t_repeat_yourself
[view]: https://en.wikipedia.org/wiki/View_(SQL)
[stored-procedure]: https://en.wikipedia.org/wiki/Stored_procedure