<?php

namespace Base;

use \Business customer as ChildBusiness customer;
use \Person as ChildPerson;
use \PersonQuery as ChildPersonQuery;
use \Exception;
use \PDO;
use Map\PersonTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'person' table.
 *
 *
 *
 * @method     ChildPersonQuery orderByPersonId($order = Criteria::ASC) Order by the person_id column
 * @method     ChildPersonQuery orderByFirstname($order = Criteria::ASC) Order by the firstname column
 * @method     ChildPersonQuery orderByLastname($order = Criteria::ASC) Order by the lastname column
 * @method     ChildPersonQuery orderByE-mail($order = Criteria::ASC) Order by the e-mail column
 * @method     ChildPersonQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method     ChildPersonQuery orderByBirthdate($order = Criteria::ASC) Order by the birthdate column
 * @method     ChildPersonQuery orderByStreet($order = Criteria::ASC) Order by the street column
 * @method     ChildPersonQuery orderByCountry($order = Criteria::ASC) Order by the country column
 * @method     ChildPersonQuery orderByZipCode($order = Criteria::ASC) Order by the zip_code column
 * @method     ChildPersonQuery orderByTypeId($order = Criteria::ASC) Order by the type_id column
 *
 * @method     ChildPersonQuery groupByPersonId() Group by the person_id column
 * @method     ChildPersonQuery groupByFirstname() Group by the firstname column
 * @method     ChildPersonQuery groupByLastname() Group by the lastname column
 * @method     ChildPersonQuery groupByE-mail() Group by the e-mail column
 * @method     ChildPersonQuery groupByPassword() Group by the password column
 * @method     ChildPersonQuery groupByBirthdate() Group by the birthdate column
 * @method     ChildPersonQuery groupByStreet() Group by the street column
 * @method     ChildPersonQuery groupByCountry() Group by the country column
 * @method     ChildPersonQuery groupByZipCode() Group by the zip_code column
 * @method     ChildPersonQuery groupByTypeId() Group by the type_id column
 *
 * @method     ChildPersonQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPersonQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPersonQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPersonQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPersonQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPersonQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPersonQuery leftJoinCity($relationAlias = null) Adds a LEFT JOIN clause to the query using the City relation
 * @method     ChildPersonQuery rightJoinCity($relationAlias = null) Adds a RIGHT JOIN clause to the query using the City relation
 * @method     ChildPersonQuery innerJoinCity($relationAlias = null) Adds a INNER JOIN clause to the query using the City relation
 *
 * @method     ChildPersonQuery joinWithCity($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the City relation
 *
 * @method     ChildPersonQuery leftJoinWithCity() Adds a LEFT JOIN clause and with to the query using the City relation
 * @method     ChildPersonQuery rightJoinWithCity() Adds a RIGHT JOIN clause and with to the query using the City relation
 * @method     ChildPersonQuery innerJoinWithCity() Adds a INNER JOIN clause and with to the query using the City relation
 *
 * @method     ChildPersonQuery leftJoinType($relationAlias = null) Adds a LEFT JOIN clause to the query using the Type relation
 * @method     ChildPersonQuery rightJoinType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Type relation
 * @method     ChildPersonQuery innerJoinType($relationAlias = null) Adds a INNER JOIN clause to the query using the Type relation
 *
 * @method     ChildPersonQuery joinWithType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Type relation
 *
 * @method     ChildPersonQuery leftJoinWithType() Adds a LEFT JOIN clause and with to the query using the Type relation
 * @method     ChildPersonQuery rightJoinWithType() Adds a RIGHT JOIN clause and with to the query using the Type relation
 * @method     ChildPersonQuery innerJoinWithType() Adds a INNER JOIN clause and with to the query using the Type relation
 *
 * @method     ChildPersonQuery leftJoinBusiness customer($relationAlias = null) Adds a LEFT JOIN clause to the query using the Business customer relation
 * @method     ChildPersonQuery rightJoinBusiness customer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Business customer relation
 * @method     ChildPersonQuery innerJoinBusiness customer($relationAlias = null) Adds a INNER JOIN clause to the query using the Business customer relation
 *
 * @method     ChildPersonQuery joinWithBusiness customer($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Business customer relation
 *
 * @method     ChildPersonQuery leftJoinWithBusiness customer() Adds a LEFT JOIN clause and with to the query using the Business customer relation
 * @method     ChildPersonQuery rightJoinWithBusiness customer() Adds a RIGHT JOIN clause and with to the query using the Business customer relation
 * @method     ChildPersonQuery innerJoinWithBusiness customer() Adds a INNER JOIN clause and with to the query using the Business customer relation
 *
 * @method     ChildPersonQuery leftJoinOrder($relationAlias = null) Adds a LEFT JOIN clause to the query using the Order relation
 * @method     ChildPersonQuery rightJoinOrder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Order relation
 * @method     ChildPersonQuery innerJoinOrder($relationAlias = null) Adds a INNER JOIN clause to the query using the Order relation
 *
 * @method     ChildPersonQuery joinWithOrder($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Order relation
 *
 * @method     ChildPersonQuery leftJoinWithOrder() Adds a LEFT JOIN clause and with to the query using the Order relation
 * @method     ChildPersonQuery rightJoinWithOrder() Adds a RIGHT JOIN clause and with to the query using the Order relation
 * @method     ChildPersonQuery innerJoinWithOrder() Adds a INNER JOIN clause and with to the query using the Order relation
 *
 * @method     ChildPersonQuery leftJoinRating($relationAlias = null) Adds a LEFT JOIN clause to the query using the Rating relation
 * @method     ChildPersonQuery rightJoinRating($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Rating relation
 * @method     ChildPersonQuery innerJoinRating($relationAlias = null) Adds a INNER JOIN clause to the query using the Rating relation
 *
 * @method     ChildPersonQuery joinWithRating($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Rating relation
 *
 * @method     ChildPersonQuery leftJoinWithRating() Adds a LEFT JOIN clause and with to the query using the Rating relation
 * @method     ChildPersonQuery rightJoinWithRating() Adds a RIGHT JOIN clause and with to the query using the Rating relation
 * @method     ChildPersonQuery innerJoinWithRating() Adds a INNER JOIN clause and with to the query using the Rating relation
 *
 * @method     \CityQuery|\TypeQuery|\Business customerQuery|\OrderQuery|\RatingQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPerson findOne(ConnectionInterface $con = null) Return the first ChildPerson matching the query
 * @method     ChildPerson findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPerson matching the query, or a new ChildPerson object populated from the query conditions when no match is found
 *
 * @method     ChildPerson findOneByPersonId(string $person_id) Return the first ChildPerson filtered by the person_id column
 * @method     ChildPerson findOneByFirstname(string $firstname) Return the first ChildPerson filtered by the firstname column
 * @method     ChildPerson findOneByLastname(string $lastname) Return the first ChildPerson filtered by the lastname column
 * @method     ChildPerson findOneByE-mail(string $e-mail) Return the first ChildPerson filtered by the e-mail column
 * @method     ChildPerson findOneByPassword(string $password) Return the first ChildPerson filtered by the password column
 * @method     ChildPerson findOneByBirthdate(string $birthdate) Return the first ChildPerson filtered by the birthdate column
 * @method     ChildPerson findOneByStreet(string $street) Return the first ChildPerson filtered by the street column
 * @method     ChildPerson findOneByCountry(string $country) Return the first ChildPerson filtered by the country column
 * @method     ChildPerson findOneByZipCode(int $zip_code) Return the first ChildPerson filtered by the zip_code column
 * @method     ChildPerson findOneByTypeId(string $type_id) Return the first ChildPerson filtered by the type_id column *

 * @method     ChildPerson requirePk($key, ConnectionInterface $con = null) Return the ChildPerson by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPerson requireOne(ConnectionInterface $con = null) Return the first ChildPerson matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPerson requireOneByPersonId(string $person_id) Return the first ChildPerson filtered by the person_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPerson requireOneByFirstname(string $firstname) Return the first ChildPerson filtered by the firstname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPerson requireOneByLastname(string $lastname) Return the first ChildPerson filtered by the lastname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPerson requireOneByE-mail(string $e-mail) Return the first ChildPerson filtered by the e-mail column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPerson requireOneByPassword(string $password) Return the first ChildPerson filtered by the password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPerson requireOneByBirthdate(string $birthdate) Return the first ChildPerson filtered by the birthdate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPerson requireOneByStreet(string $street) Return the first ChildPerson filtered by the street column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPerson requireOneByCountry(string $country) Return the first ChildPerson filtered by the country column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPerson requireOneByZipCode(int $zip_code) Return the first ChildPerson filtered by the zip_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPerson requireOneByTypeId(string $type_id) Return the first ChildPerson filtered by the type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPerson[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPerson objects based on current ModelCriteria
 * @method     ChildPerson[]|ObjectCollection findByPersonId(string $person_id) Return ChildPerson objects filtered by the person_id column
 * @method     ChildPerson[]|ObjectCollection findByFirstname(string $firstname) Return ChildPerson objects filtered by the firstname column
 * @method     ChildPerson[]|ObjectCollection findByLastname(string $lastname) Return ChildPerson objects filtered by the lastname column
 * @method     ChildPerson[]|ObjectCollection findByE-mail(string $e-mail) Return ChildPerson objects filtered by the e-mail column
 * @method     ChildPerson[]|ObjectCollection findByPassword(string $password) Return ChildPerson objects filtered by the password column
 * @method     ChildPerson[]|ObjectCollection findByBirthdate(string $birthdate) Return ChildPerson objects filtered by the birthdate column
 * @method     ChildPerson[]|ObjectCollection findByStreet(string $street) Return ChildPerson objects filtered by the street column
 * @method     ChildPerson[]|ObjectCollection findByCountry(string $country) Return ChildPerson objects filtered by the country column
 * @method     ChildPerson[]|ObjectCollection findByZipCode(int $zip_code) Return ChildPerson objects filtered by the zip_code column
 * @method     ChildPerson[]|ObjectCollection findByTypeId(string $type_id) Return ChildPerson objects filtered by the type_id column
 * @method     ChildPerson[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PersonQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PersonQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'FST4', $modelName = '\\Person', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPersonQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPersonQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPersonQuery) {
            return $criteria;
        }
        $query = new ChildPersonQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildPerson|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PersonTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PersonTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPerson A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT person_id, firstname, lastname, e-mail, password, birthdate, street, country, zip_code, type_id FROM person WHERE person_id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildPerson $obj */
            $obj = new ChildPerson();
            $obj->hydrate($row);
            PersonTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildPerson|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildPersonQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PersonTableMap::COL_PERSON_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPersonQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PersonTableMap::COL_PERSON_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the person_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPersonId('fooValue');   // WHERE person_id = 'fooValue'
     * $query->filterByPersonId('%fooValue%', Criteria::LIKE); // WHERE person_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $personId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersonQuery The current query, for fluid interface
     */
    public function filterByPersonId($personId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($personId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersonTableMap::COL_PERSON_ID, $personId, $comparison);
    }

    /**
     * Filter the query on the firstname column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstname('fooValue');   // WHERE firstname = 'fooValue'
     * $query->filterByFirstname('%fooValue%', Criteria::LIKE); // WHERE firstname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $firstname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersonQuery The current query, for fluid interface
     */
    public function filterByFirstname($firstname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersonTableMap::COL_FIRSTNAME, $firstname, $comparison);
    }

    /**
     * Filter the query on the lastname column
     *
     * Example usage:
     * <code>
     * $query->filterByLastname('fooValue');   // WHERE lastname = 'fooValue'
     * $query->filterByLastname('%fooValue%', Criteria::LIKE); // WHERE lastname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lastname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersonQuery The current query, for fluid interface
     */
    public function filterByLastname($lastname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersonTableMap::COL_LASTNAME, $lastname, $comparison);
    }

    /**
     * Filter the query on the e-mail column
     *
     * Example usage:
     * <code>
     * $query->filterByE-mail('fooValue');   // WHERE e-mail = 'fooValue'
     * $query->filterByE-mail('%fooValue%', Criteria::LIKE); // WHERE e-mail LIKE '%fooValue%'
     * </code>
     *
     * @param     string $e-mail The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersonQuery The current query, for fluid interface
     */
    public function filterByE-mail($e-mail = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($e-mail)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersonTableMap::COL_E-MAIL, $e-mail, $comparison);
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterByPassword('%fooValue%', Criteria::LIKE); // WHERE password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $password The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersonQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersonTableMap::COL_PASSWORD, $password, $comparison);
    }

    /**
     * Filter the query on the birthdate column
     *
     * Example usage:
     * <code>
     * $query->filterByBirthdate('fooValue');   // WHERE birthdate = 'fooValue'
     * $query->filterByBirthdate('%fooValue%', Criteria::LIKE); // WHERE birthdate LIKE '%fooValue%'
     * </code>
     *
     * @param     string $birthdate The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersonQuery The current query, for fluid interface
     */
    public function filterByBirthdate($birthdate = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($birthdate)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersonTableMap::COL_BIRTHDATE, $birthdate, $comparison);
    }

    /**
     * Filter the query on the street column
     *
     * Example usage:
     * <code>
     * $query->filterByStreet('fooValue');   // WHERE street = 'fooValue'
     * $query->filterByStreet('%fooValue%', Criteria::LIKE); // WHERE street LIKE '%fooValue%'
     * </code>
     *
     * @param     string $street The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersonQuery The current query, for fluid interface
     */
    public function filterByStreet($street = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($street)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersonTableMap::COL_STREET, $street, $comparison);
    }

    /**
     * Filter the query on the country column
     *
     * Example usage:
     * <code>
     * $query->filterByCountry('fooValue');   // WHERE country = 'fooValue'
     * $query->filterByCountry('%fooValue%', Criteria::LIKE); // WHERE country LIKE '%fooValue%'
     * </code>
     *
     * @param     string $country The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersonQuery The current query, for fluid interface
     */
    public function filterByCountry($country = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($country)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersonTableMap::COL_COUNTRY, $country, $comparison);
    }

    /**
     * Filter the query on the zip_code column
     *
     * Example usage:
     * <code>
     * $query->filterByZipCode(1234); // WHERE zip_code = 1234
     * $query->filterByZipCode(array(12, 34)); // WHERE zip_code IN (12, 34)
     * $query->filterByZipCode(array('min' => 12)); // WHERE zip_code > 12
     * </code>
     *
     * @see       filterByCity()
     *
     * @param     mixed $zipCode The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersonQuery The current query, for fluid interface
     */
    public function filterByZipCode($zipCode = null, $comparison = null)
    {
        if (is_array($zipCode)) {
            $useMinMax = false;
            if (isset($zipCode['min'])) {
                $this->addUsingAlias(PersonTableMap::COL_ZIP_CODE, $zipCode['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($zipCode['max'])) {
                $this->addUsingAlias(PersonTableMap::COL_ZIP_CODE, $zipCode['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersonTableMap::COL_ZIP_CODE, $zipCode, $comparison);
    }

    /**
     * Filter the query on the type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTypeId('fooValue');   // WHERE type_id = 'fooValue'
     * $query->filterByTypeId('%fooValue%', Criteria::LIKE); // WHERE type_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $typeId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersonQuery The current query, for fluid interface
     */
    public function filterByTypeId($typeId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($typeId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersonTableMap::COL_TYPE_ID, $typeId, $comparison);
    }

    /**
     * Filter the query by a related \City object
     *
     * @param \City|ObjectCollection $city The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPersonQuery The current query, for fluid interface
     */
    public function filterByCity($city, $comparison = null)
    {
        if ($city instanceof \City) {
            return $this
                ->addUsingAlias(PersonTableMap::COL_ZIP_CODE, $city->getZipCode(), $comparison);
        } elseif ($city instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PersonTableMap::COL_ZIP_CODE, $city->toKeyValue('PrimaryKey', 'ZipCode'), $comparison);
        } else {
            throw new PropelException('filterByCity() only accepts arguments of type \City or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the City relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPersonQuery The current query, for fluid interface
     */
    public function joinCity($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('City');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'City');
        }

        return $this;
    }

    /**
     * Use the City relation City object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CityQuery A secondary query class using the current class as primary query
     */
    public function useCityQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCity($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'City', '\CityQuery');
    }

    /**
     * Filter the query by a related \Type object
     *
     * @param \Type|ObjectCollection $type The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPersonQuery The current query, for fluid interface
     */
    public function filterByType($type, $comparison = null)
    {
        if ($type instanceof \Type) {
            return $this
                ->addUsingAlias(PersonTableMap::COL_TYPE_ID, $type->getTypeId(), $comparison);
        } elseif ($type instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PersonTableMap::COL_TYPE_ID, $type->toKeyValue('PrimaryKey', 'TypeId'), $comparison);
        } else {
            throw new PropelException('filterByType() only accepts arguments of type \Type or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Type relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPersonQuery The current query, for fluid interface
     */
    public function joinType($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Type');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Type');
        }

        return $this;
    }

    /**
     * Use the Type relation Type object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TypeQuery A secondary query class using the current class as primary query
     */
    public function useTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Type', '\TypeQuery');
    }

    /**
     * Filter the query by a related \Business customer object
     *
     * @param \Business customer|ObjectCollection $business customer the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPersonQuery The current query, for fluid interface
     */
    public function filterByBusiness customer($business customer, $comparison = null)
    {
        if ($business customer instanceof \Business customer) {
            return $this
                ->addUsingAlias(PersonTableMap::COL_PERSON_ID, $business customer->getPersonId(), $comparison);
        } elseif ($business customer instanceof ObjectCollection) {
            return $this
                ->useBusiness customerQuery()
                ->filterByPrimaryKeys($business customer->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBusiness customer() only accepts arguments of type \Business customer or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Business customer relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPersonQuery The current query, for fluid interface
     */
    public function joinBusiness customer($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Business customer');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Business customer');
        }

        return $this;
    }

    /**
     * Use the Business customer relation Business customer object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Business customerQuery A secondary query class using the current class as primary query
     */
    public function useBusiness customerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBusiness customer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Business customer', '\Business customerQuery');
    }

    /**
     * Filter the query by a related \Order object
     *
     * @param \Order|ObjectCollection $order the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPersonQuery The current query, for fluid interface
     */
    public function filterByOrder($order, $comparison = null)
    {
        if ($order instanceof \Order) {
            return $this
                ->addUsingAlias(PersonTableMap::COL_PERSON_ID, $order->getPersonId(), $comparison);
        } elseif ($order instanceof ObjectCollection) {
            return $this
                ->useOrderQuery()
                ->filterByPrimaryKeys($order->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByOrder() only accepts arguments of type \Order or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Order relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPersonQuery The current query, for fluid interface
     */
    public function joinOrder($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Order');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Order');
        }

        return $this;
    }

    /**
     * Use the Order relation Order object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \OrderQuery A secondary query class using the current class as primary query
     */
    public function useOrderQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrder($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Order', '\OrderQuery');
    }

    /**
     * Filter the query by a related \Rating object
     *
     * @param \Rating|ObjectCollection $rating the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPersonQuery The current query, for fluid interface
     */
    public function filterByRating($rating, $comparison = null)
    {
        if ($rating instanceof \Rating) {
            return $this
                ->addUsingAlias(PersonTableMap::COL_PERSON_ID, $rating->getPersonId(), $comparison);
        } elseif ($rating instanceof ObjectCollection) {
            return $this
                ->useRatingQuery()
                ->filterByPrimaryKeys($rating->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRating() only accepts arguments of type \Rating or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Rating relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPersonQuery The current query, for fluid interface
     */
    public function joinRating($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Rating');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Rating');
        }

        return $this;
    }

    /**
     * Use the Rating relation Rating object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RatingQuery A secondary query class using the current class as primary query
     */
    public function useRatingQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRating($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Rating', '\RatingQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPerson $person Object to remove from the list of results
     *
     * @return $this|ChildPersonQuery The current query, for fluid interface
     */
    public function prune($person = null)
    {
        if ($person) {
            $this->addUsingAlias(PersonTableMap::COL_PERSON_ID, $person->getPersonId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the person table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PersonTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PersonTableMap::clearInstancePool();
            PersonTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PersonTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PersonTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PersonTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PersonTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PersonQuery
