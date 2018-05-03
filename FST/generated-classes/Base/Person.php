<?php

namespace Base;

use \BusinessCustomer as ChildBusinessCustomer;
use \BusinessCustomerQuery as ChildBusinessCustomerQuery;
use \City as ChildCity;
use \CityQuery as ChildCityQuery;
use \Order as ChildOrder;
use \OrderQuery as ChildOrderQuery;
use \Person as ChildPerson;
use \PersonQuery as ChildPersonQuery;
use \Rating as ChildRating;
use \RatingQuery as ChildRatingQuery;
use \Type as ChildType;
use \TypeQuery as ChildTypeQuery;
use \Exception;
use \PDO;
use Map\BusinessCustomerTableMap;
use Map\OrderTableMap;
use Map\PersonTableMap;
use Map\RatingTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'person' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Person implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\PersonTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the person_id field.
     *
     * @var        int
     */
    protected $person_id;

    /**
     * The value for the firstname field.
     *
     * @var        string
     */
    protected $firstname;

    /**
     * The value for the lastname field.
     *
     * @var        string
     */
    protected $lastname;

    /**
     * The value for the email field.
     *
     * @var        string
     */
    protected $email;

    /**
     * The value for the password field.
     *
     * @var        string
     */
    protected $password;

    /**
     * The value for the birthdate field.
     *
     * @var        string
     */
    protected $birthdate;

    /**
     * The value for the street field.
     *
     * @var        string
     */
    protected $street;

    /**
     * The value for the country field.
     *
     * @var        string
     */
    protected $country;

    /**
     * The value for the zip_code field.
     *
     * @var        int
     */
    protected $zip_code;

    /**
     * The value for the type_id field.
     *
     * @var        int
     */
    protected $type_id;

    /**
     * @var        ChildCity
     */
    protected $aCity;

    /**
     * @var        ChildType
     */
    protected $aType;

    /**
     * @var        ObjectCollection|ChildBusinessCustomer[] Collection to store aggregation of ChildBusinessCustomer objects.
     */
    protected $collBusinessCustomers;
    protected $collBusinessCustomersPartial;

    /**
     * @var        ObjectCollection|ChildOrder[] Collection to store aggregation of ChildOrder objects.
     */
    protected $collOrders;
    protected $collOrdersPartial;

    /**
     * @var        ObjectCollection|ChildRating[] Collection to store aggregation of ChildRating objects.
     */
    protected $collRatings;
    protected $collRatingsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBusinessCustomer[]
     */
    protected $businessCustomersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrder[]
     */
    protected $ordersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildRating[]
     */
    protected $ratingsScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Person object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Person</code> instance.  If
     * <code>obj</code> is an instance of <code>Person</code>, delegates to
     * <code>equals(Person)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Person The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [person_id] column value.
     *
     * @return int
     */
    public function getPersonId()
    {
        return $this->person_id;
    }

    /**
     * Get the [firstname] column value.
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Get the [lastname] column value.
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [password] column value.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the [birthdate] column value.
     *
     * @return string
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Get the [street] column value.
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Get the [country] column value.
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Get the [zip_code] column value.
     *
     * @return int
     */
    public function getZipCode()
    {
        return $this->zip_code;
    }

    /**
     * Get the [type_id] column value.
     *
     * @return int
     */
    public function getTypeId()
    {
        return $this->type_id;
    }

    /**
     * Set the value of [person_id] column.
     *
     * @param int $v new value
     * @return $this|\Person The current object (for fluent API support)
     */
    public function setPersonId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->person_id !== $v) {
            $this->person_id = $v;
            $this->modifiedColumns[PersonTableMap::COL_PERSON_ID] = true;
        }

        return $this;
    } // setPersonId()

    /**
     * Set the value of [firstname] column.
     *
     * @param string $v new value
     * @return $this|\Person The current object (for fluent API support)
     */
    public function setFirstname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->firstname !== $v) {
            $this->firstname = $v;
            $this->modifiedColumns[PersonTableMap::COL_FIRSTNAME] = true;
        }

        return $this;
    } // setFirstname()

    /**
     * Set the value of [lastname] column.
     *
     * @param string $v new value
     * @return $this|\Person The current object (for fluent API support)
     */
    public function setLastname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->lastname !== $v) {
            $this->lastname = $v;
            $this->modifiedColumns[PersonTableMap::COL_LASTNAME] = true;
        }

        return $this;
    } // setLastname()

    /**
     * Set the value of [email] column.
     *
     * @param string $v new value
     * @return $this|\Person The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[PersonTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [password] column.
     *
     * @param string $v new value
     * @return $this|\Person The current object (for fluent API support)
     */
    public function setPassword($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->password !== $v) {
            $this->password = $v;
            $this->modifiedColumns[PersonTableMap::COL_PASSWORD] = true;
        }

        return $this;
    } // setPassword()

    /**
     * Set the value of [birthdate] column.
     *
     * @param string $v new value
     * @return $this|\Person The current object (for fluent API support)
     */
    public function setBirthdate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->birthdate !== $v) {
            $this->birthdate = $v;
            $this->modifiedColumns[PersonTableMap::COL_BIRTHDATE] = true;
        }

        return $this;
    } // setBirthdate()

    /**
     * Set the value of [street] column.
     *
     * @param string $v new value
     * @return $this|\Person The current object (for fluent API support)
     */
    public function setStreet($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->street !== $v) {
            $this->street = $v;
            $this->modifiedColumns[PersonTableMap::COL_STREET] = true;
        }

        return $this;
    } // setStreet()

    /**
     * Set the value of [country] column.
     *
     * @param string $v new value
     * @return $this|\Person The current object (for fluent API support)
     */
    public function setCountry($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->country !== $v) {
            $this->country = $v;
            $this->modifiedColumns[PersonTableMap::COL_COUNTRY] = true;
        }

        return $this;
    } // setCountry()

    /**
     * Set the value of [zip_code] column.
     *
     * @param int $v new value
     * @return $this|\Person The current object (for fluent API support)
     */
    public function setZipCode($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->zip_code !== $v) {
            $this->zip_code = $v;
            $this->modifiedColumns[PersonTableMap::COL_ZIP_CODE] = true;
        }

        if ($this->aCity !== null && $this->aCity->getZipCode() !== $v) {
            $this->aCity = null;
        }

        return $this;
    } // setZipCode()

    /**
     * Set the value of [type_id] column.
     *
     * @param int $v new value
     * @return $this|\Person The current object (for fluent API support)
     */
    public function setTypeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->type_id !== $v) {
            $this->type_id = $v;
            $this->modifiedColumns[PersonTableMap::COL_TYPE_ID] = true;
        }

        if ($this->aType !== null && $this->aType->getTypeId() !== $v) {
            $this->aType = null;
        }

        return $this;
    } // setTypeId()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PersonTableMap::translateFieldName('PersonId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->person_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PersonTableMap::translateFieldName('Firstname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->firstname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PersonTableMap::translateFieldName('Lastname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->lastname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : PersonTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : PersonTableMap::translateFieldName('Password', TableMap::TYPE_PHPNAME, $indexType)];
            $this->password = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : PersonTableMap::translateFieldName('Birthdate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->birthdate = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : PersonTableMap::translateFieldName('Street', TableMap::TYPE_PHPNAME, $indexType)];
            $this->street = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : PersonTableMap::translateFieldName('Country', TableMap::TYPE_PHPNAME, $indexType)];
            $this->country = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : PersonTableMap::translateFieldName('ZipCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zip_code = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : PersonTableMap::translateFieldName('TypeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->type_id = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = PersonTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Person'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aCity !== null && $this->zip_code !== $this->aCity->getZipCode()) {
            $this->aCity = null;
        }
        if ($this->aType !== null && $this->type_id !== $this->aType->getTypeId()) {
            $this->aType = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PersonTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPersonQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCity = null;
            $this->aType = null;
            $this->collBusinessCustomers = null;

            $this->collOrders = null;

            $this->collRatings = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Person::setDeleted()
     * @see Person::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PersonTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPersonQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PersonTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                PersonTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aCity !== null) {
                if ($this->aCity->isModified() || $this->aCity->isNew()) {
                    $affectedRows += $this->aCity->save($con);
                }
                $this->setCity($this->aCity);
            }

            if ($this->aType !== null) {
                if ($this->aType->isModified() || $this->aType->isNew()) {
                    $affectedRows += $this->aType->save($con);
                }
                $this->setType($this->aType);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->businessCustomersScheduledForDeletion !== null) {
                if (!$this->businessCustomersScheduledForDeletion->isEmpty()) {
                    \BusinessCustomerQuery::create()
                        ->filterByPrimaryKeys($this->businessCustomersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->businessCustomersScheduledForDeletion = null;
                }
            }

            if ($this->collBusinessCustomers !== null) {
                foreach ($this->collBusinessCustomers as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->ordersScheduledForDeletion !== null) {
                if (!$this->ordersScheduledForDeletion->isEmpty()) {
                    \OrderQuery::create()
                        ->filterByPrimaryKeys($this->ordersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->ordersScheduledForDeletion = null;
                }
            }

            if ($this->collOrders !== null) {
                foreach ($this->collOrders as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->ratingsScheduledForDeletion !== null) {
                if (!$this->ratingsScheduledForDeletion->isEmpty()) {
                    \RatingQuery::create()
                        ->filterByPrimaryKeys($this->ratingsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->ratingsScheduledForDeletion = null;
                }
            }

            if ($this->collRatings !== null) {
                foreach ($this->collRatings as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[PersonTableMap::COL_PERSON_ID] = true;
        if (null !== $this->person_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PersonTableMap::COL_PERSON_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PersonTableMap::COL_PERSON_ID)) {
            $modifiedColumns[':p' . $index++]  = 'person_id';
        }
        if ($this->isColumnModified(PersonTableMap::COL_FIRSTNAME)) {
            $modifiedColumns[':p' . $index++]  = 'firstname';
        }
        if ($this->isColumnModified(PersonTableMap::COL_LASTNAME)) {
            $modifiedColumns[':p' . $index++]  = 'lastname';
        }
        if ($this->isColumnModified(PersonTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'email';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PASSWORD)) {
            $modifiedColumns[':p' . $index++]  = 'password';
        }
        if ($this->isColumnModified(PersonTableMap::COL_BIRTHDATE)) {
            $modifiedColumns[':p' . $index++]  = 'birthdate';
        }
        if ($this->isColumnModified(PersonTableMap::COL_STREET)) {
            $modifiedColumns[':p' . $index++]  = 'street';
        }
        if ($this->isColumnModified(PersonTableMap::COL_COUNTRY)) {
            $modifiedColumns[':p' . $index++]  = 'country';
        }
        if ($this->isColumnModified(PersonTableMap::COL_ZIP_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'zip_code';
        }
        if ($this->isColumnModified(PersonTableMap::COL_TYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'type_id';
        }

        $sql = sprintf(
            'INSERT INTO person (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'person_id':
                        $stmt->bindValue($identifier, $this->person_id, PDO::PARAM_INT);
                        break;
                    case 'firstname':
                        $stmt->bindValue($identifier, $this->firstname, PDO::PARAM_STR);
                        break;
                    case 'lastname':
                        $stmt->bindValue($identifier, $this->lastname, PDO::PARAM_STR);
                        break;
                    case 'email':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'password':
                        $stmt->bindValue($identifier, $this->password, PDO::PARAM_STR);
                        break;
                    case 'birthdate':
                        $stmt->bindValue($identifier, $this->birthdate, PDO::PARAM_STR);
                        break;
                    case 'street':
                        $stmt->bindValue($identifier, $this->street, PDO::PARAM_STR);
                        break;
                    case 'country':
                        $stmt->bindValue($identifier, $this->country, PDO::PARAM_STR);
                        break;
                    case 'zip_code':
                        $stmt->bindValue($identifier, $this->zip_code, PDO::PARAM_INT);
                        break;
                    case 'type_id':
                        $stmt->bindValue($identifier, $this->type_id, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setPersonId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PersonTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getPersonId();
                break;
            case 1:
                return $this->getFirstname();
                break;
            case 2:
                return $this->getLastname();
                break;
            case 3:
                return $this->getEmail();
                break;
            case 4:
                return $this->getPassword();
                break;
            case 5:
                return $this->getBirthdate();
                break;
            case 6:
                return $this->getStreet();
                break;
            case 7:
                return $this->getCountry();
                break;
            case 8:
                return $this->getZipCode();
                break;
            case 9:
                return $this->getTypeId();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Person'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Person'][$this->hashCode()] = true;
        $keys = PersonTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getPersonId(),
            $keys[1] => $this->getFirstname(),
            $keys[2] => $this->getLastname(),
            $keys[3] => $this->getEmail(),
            $keys[4] => $this->getPassword(),
            $keys[5] => $this->getBirthdate(),
            $keys[6] => $this->getStreet(),
            $keys[7] => $this->getCountry(),
            $keys[8] => $this->getZipCode(),
            $keys[9] => $this->getTypeId(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aCity) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'city';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'city';
                        break;
                    default:
                        $key = 'City';
                }

                $result[$key] = $this->aCity->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aType) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'type';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'type';
                        break;
                    default:
                        $key = 'Type';
                }

                $result[$key] = $this->aType->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collBusinessCustomers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'businessCustomers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'business_customers';
                        break;
                    default:
                        $key = 'BusinessCustomers';
                }

                $result[$key] = $this->collBusinessCustomers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOrders) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orders';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'orders';
                        break;
                    default:
                        $key = 'Orders';
                }

                $result[$key] = $this->collOrders->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collRatings) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'ratings';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'ratings';
                        break;
                    default:
                        $key = 'Ratings';
                }

                $result[$key] = $this->collRatings->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Person
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PersonTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Person
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setPersonId($value);
                break;
            case 1:
                $this->setFirstname($value);
                break;
            case 2:
                $this->setLastname($value);
                break;
            case 3:
                $this->setEmail($value);
                break;
            case 4:
                $this->setPassword($value);
                break;
            case 5:
                $this->setBirthdate($value);
                break;
            case 6:
                $this->setStreet($value);
                break;
            case 7:
                $this->setCountry($value);
                break;
            case 8:
                $this->setZipCode($value);
                break;
            case 9:
                $this->setTypeId($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = PersonTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setPersonId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFirstname($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setLastname($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setEmail($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setPassword($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setBirthdate($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setStreet($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCountry($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setZipCode($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setTypeId($arr[$keys[9]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Person The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(PersonTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PersonTableMap::COL_PERSON_ID)) {
            $criteria->add(PersonTableMap::COL_PERSON_ID, $this->person_id);
        }
        if ($this->isColumnModified(PersonTableMap::COL_FIRSTNAME)) {
            $criteria->add(PersonTableMap::COL_FIRSTNAME, $this->firstname);
        }
        if ($this->isColumnModified(PersonTableMap::COL_LASTNAME)) {
            $criteria->add(PersonTableMap::COL_LASTNAME, $this->lastname);
        }
        if ($this->isColumnModified(PersonTableMap::COL_EMAIL)) {
            $criteria->add(PersonTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PASSWORD)) {
            $criteria->add(PersonTableMap::COL_PASSWORD, $this->password);
        }
        if ($this->isColumnModified(PersonTableMap::COL_BIRTHDATE)) {
            $criteria->add(PersonTableMap::COL_BIRTHDATE, $this->birthdate);
        }
        if ($this->isColumnModified(PersonTableMap::COL_STREET)) {
            $criteria->add(PersonTableMap::COL_STREET, $this->street);
        }
        if ($this->isColumnModified(PersonTableMap::COL_COUNTRY)) {
            $criteria->add(PersonTableMap::COL_COUNTRY, $this->country);
        }
        if ($this->isColumnModified(PersonTableMap::COL_ZIP_CODE)) {
            $criteria->add(PersonTableMap::COL_ZIP_CODE, $this->zip_code);
        }
        if ($this->isColumnModified(PersonTableMap::COL_TYPE_ID)) {
            $criteria->add(PersonTableMap::COL_TYPE_ID, $this->type_id);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildPersonQuery::create();
        $criteria->add(PersonTableMap::COL_PERSON_ID, $this->person_id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getPersonId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getPersonId();
    }

    /**
     * Generic method to set the primary key (person_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setPersonId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getPersonId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Person (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setFirstname($this->getFirstname());
        $copyObj->setLastname($this->getLastname());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setPassword($this->getPassword());
        $copyObj->setBirthdate($this->getBirthdate());
        $copyObj->setStreet($this->getStreet());
        $copyObj->setCountry($this->getCountry());
        $copyObj->setZipCode($this->getZipCode());
        $copyObj->setTypeId($this->getTypeId());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBusinessCustomers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBusinessCustomer($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOrders() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrder($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getRatings() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRating($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setPersonId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Person Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildCity object.
     *
     * @param  ChildCity $v
     * @return $this|\Person The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCity(ChildCity $v = null)
    {
        if ($v === null) {
            $this->setZipCode(NULL);
        } else {
            $this->setZipCode($v->getZipCode());
        }

        $this->aCity = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCity object, it will not be re-added.
        if ($v !== null) {
            $v->addPerson($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCity object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildCity The associated ChildCity object.
     * @throws PropelException
     */
    public function getCity(ConnectionInterface $con = null)
    {
        if ($this->aCity === null && ($this->zip_code != 0)) {
            $this->aCity = ChildCityQuery::create()->findPk($this->zip_code, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCity->addPeople($this);
             */
        }

        return $this->aCity;
    }

    /**
     * Declares an association between this object and a ChildType object.
     *
     * @param  ChildType $v
     * @return $this|\Person The current object (for fluent API support)
     * @throws PropelException
     */
    public function setType(ChildType $v = null)
    {
        if ($v === null) {
            $this->setTypeId(NULL);
        } else {
            $this->setTypeId($v->getTypeId());
        }

        $this->aType = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildType object, it will not be re-added.
        if ($v !== null) {
            $v->addPerson($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildType object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildType The associated ChildType object.
     * @throws PropelException
     */
    public function getType(ConnectionInterface $con = null)
    {
        if ($this->aType === null && ($this->type_id != 0)) {
            $this->aType = ChildTypeQuery::create()->findPk($this->type_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aType->addPeople($this);
             */
        }

        return $this->aType;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('BusinessCustomer' == $relationName) {
            $this->initBusinessCustomers();
            return;
        }
        if ('Order' == $relationName) {
            $this->initOrders();
            return;
        }
        if ('Rating' == $relationName) {
            $this->initRatings();
            return;
        }
    }

    /**
     * Clears out the collBusinessCustomers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBusinessCustomers()
     */
    public function clearBusinessCustomers()
    {
        $this->collBusinessCustomers = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBusinessCustomers collection loaded partially.
     */
    public function resetPartialBusinessCustomers($v = true)
    {
        $this->collBusinessCustomersPartial = $v;
    }

    /**
     * Initializes the collBusinessCustomers collection.
     *
     * By default this just sets the collBusinessCustomers collection to an empty array (like clearcollBusinessCustomers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBusinessCustomers($overrideExisting = true)
    {
        if (null !== $this->collBusinessCustomers && !$overrideExisting) {
            return;
        }

        $collectionClassName = BusinessCustomerTableMap::getTableMap()->getCollectionClassName();

        $this->collBusinessCustomers = new $collectionClassName;
        $this->collBusinessCustomers->setModel('\BusinessCustomer');
    }

    /**
     * Gets an array of ChildBusinessCustomer objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPerson is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBusinessCustomer[] List of ChildBusinessCustomer objects
     * @throws PropelException
     */
    public function getBusinessCustomers(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBusinessCustomersPartial && !$this->isNew();
        if (null === $this->collBusinessCustomers || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBusinessCustomers) {
                // return empty collection
                $this->initBusinessCustomers();
            } else {
                $collBusinessCustomers = ChildBusinessCustomerQuery::create(null, $criteria)
                    ->filterByPerson($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBusinessCustomersPartial && count($collBusinessCustomers)) {
                        $this->initBusinessCustomers(false);

                        foreach ($collBusinessCustomers as $obj) {
                            if (false == $this->collBusinessCustomers->contains($obj)) {
                                $this->collBusinessCustomers->append($obj);
                            }
                        }

                        $this->collBusinessCustomersPartial = true;
                    }

                    return $collBusinessCustomers;
                }

                if ($partial && $this->collBusinessCustomers) {
                    foreach ($this->collBusinessCustomers as $obj) {
                        if ($obj->isNew()) {
                            $collBusinessCustomers[] = $obj;
                        }
                    }
                }

                $this->collBusinessCustomers = $collBusinessCustomers;
                $this->collBusinessCustomersPartial = false;
            }
        }

        return $this->collBusinessCustomers;
    }

    /**
     * Sets a collection of ChildBusinessCustomer objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $businessCustomers A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPerson The current object (for fluent API support)
     */
    public function setBusinessCustomers(Collection $businessCustomers, ConnectionInterface $con = null)
    {
        /** @var ChildBusinessCustomer[] $businessCustomersToDelete */
        $businessCustomersToDelete = $this->getBusinessCustomers(new Criteria(), $con)->diff($businessCustomers);


        $this->businessCustomersScheduledForDeletion = $businessCustomersToDelete;

        foreach ($businessCustomersToDelete as $businessCustomerRemoved) {
            $businessCustomerRemoved->setPerson(null);
        }

        $this->collBusinessCustomers = null;
        foreach ($businessCustomers as $businessCustomer) {
            $this->addBusinessCustomer($businessCustomer);
        }

        $this->collBusinessCustomers = $businessCustomers;
        $this->collBusinessCustomersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BusinessCustomer objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related BusinessCustomer objects.
     * @throws PropelException
     */
    public function countBusinessCustomers(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBusinessCustomersPartial && !$this->isNew();
        if (null === $this->collBusinessCustomers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBusinessCustomers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBusinessCustomers());
            }

            $query = ChildBusinessCustomerQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPerson($this)
                ->count($con);
        }

        return count($this->collBusinessCustomers);
    }

    /**
     * Method called to associate a ChildBusinessCustomer object to this object
     * through the ChildBusinessCustomer foreign key attribute.
     *
     * @param  ChildBusinessCustomer $l ChildBusinessCustomer
     * @return $this|\Person The current object (for fluent API support)
     */
    public function addBusinessCustomer(ChildBusinessCustomer $l)
    {
        if ($this->collBusinessCustomers === null) {
            $this->initBusinessCustomers();
            $this->collBusinessCustomersPartial = true;
        }

        if (!$this->collBusinessCustomers->contains($l)) {
            $this->doAddBusinessCustomer($l);

            if ($this->businessCustomersScheduledForDeletion and $this->businessCustomersScheduledForDeletion->contains($l)) {
                $this->businessCustomersScheduledForDeletion->remove($this->businessCustomersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBusinessCustomer $businessCustomer The ChildBusinessCustomer object to add.
     */
    protected function doAddBusinessCustomer(ChildBusinessCustomer $businessCustomer)
    {
        $this->collBusinessCustomers[]= $businessCustomer;
        $businessCustomer->setPerson($this);
    }

    /**
     * @param  ChildBusinessCustomer $businessCustomer The ChildBusinessCustomer object to remove.
     * @return $this|ChildPerson The current object (for fluent API support)
     */
    public function removeBusinessCustomer(ChildBusinessCustomer $businessCustomer)
    {
        if ($this->getBusinessCustomers()->contains($businessCustomer)) {
            $pos = $this->collBusinessCustomers->search($businessCustomer);
            $this->collBusinessCustomers->remove($pos);
            if (null === $this->businessCustomersScheduledForDeletion) {
                $this->businessCustomersScheduledForDeletion = clone $this->collBusinessCustomers;
                $this->businessCustomersScheduledForDeletion->clear();
            }
            $this->businessCustomersScheduledForDeletion[]= clone $businessCustomer;
            $businessCustomer->setPerson(null);
        }

        return $this;
    }

    /**
     * Clears out the collOrders collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addOrders()
     */
    public function clearOrders()
    {
        $this->collOrders = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collOrders collection loaded partially.
     */
    public function resetPartialOrders($v = true)
    {
        $this->collOrdersPartial = $v;
    }

    /**
     * Initializes the collOrders collection.
     *
     * By default this just sets the collOrders collection to an empty array (like clearcollOrders());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOrders($overrideExisting = true)
    {
        if (null !== $this->collOrders && !$overrideExisting) {
            return;
        }

        $collectionClassName = OrderTableMap::getTableMap()->getCollectionClassName();

        $this->collOrders = new $collectionClassName;
        $this->collOrders->setModel('\Order');
    }

    /**
     * Gets an array of ChildOrder objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPerson is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOrder[] List of ChildOrder objects
     * @throws PropelException
     */
    public function getOrders(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collOrdersPartial && !$this->isNew();
        if (null === $this->collOrders || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collOrders) {
                // return empty collection
                $this->initOrders();
            } else {
                $collOrders = ChildOrderQuery::create(null, $criteria)
                    ->filterByPerson($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOrdersPartial && count($collOrders)) {
                        $this->initOrders(false);

                        foreach ($collOrders as $obj) {
                            if (false == $this->collOrders->contains($obj)) {
                                $this->collOrders->append($obj);
                            }
                        }

                        $this->collOrdersPartial = true;
                    }

                    return $collOrders;
                }

                if ($partial && $this->collOrders) {
                    foreach ($this->collOrders as $obj) {
                        if ($obj->isNew()) {
                            $collOrders[] = $obj;
                        }
                    }
                }

                $this->collOrders = $collOrders;
                $this->collOrdersPartial = false;
            }
        }

        return $this->collOrders;
    }

    /**
     * Sets a collection of ChildOrder objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $orders A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPerson The current object (for fluent API support)
     */
    public function setOrders(Collection $orders, ConnectionInterface $con = null)
    {
        /** @var ChildOrder[] $ordersToDelete */
        $ordersToDelete = $this->getOrders(new Criteria(), $con)->diff($orders);


        $this->ordersScheduledForDeletion = $ordersToDelete;

        foreach ($ordersToDelete as $orderRemoved) {
            $orderRemoved->setPerson(null);
        }

        $this->collOrders = null;
        foreach ($orders as $order) {
            $this->addOrder($order);
        }

        $this->collOrders = $orders;
        $this->collOrdersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Order objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Order objects.
     * @throws PropelException
     */
    public function countOrders(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collOrdersPartial && !$this->isNew();
        if (null === $this->collOrders || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOrders) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOrders());
            }

            $query = ChildOrderQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPerson($this)
                ->count($con);
        }

        return count($this->collOrders);
    }

    /**
     * Method called to associate a ChildOrder object to this object
     * through the ChildOrder foreign key attribute.
     *
     * @param  ChildOrder $l ChildOrder
     * @return $this|\Person The current object (for fluent API support)
     */
    public function addOrder(ChildOrder $l)
    {
        if ($this->collOrders === null) {
            $this->initOrders();
            $this->collOrdersPartial = true;
        }

        if (!$this->collOrders->contains($l)) {
            $this->doAddOrder($l);

            if ($this->ordersScheduledForDeletion and $this->ordersScheduledForDeletion->contains($l)) {
                $this->ordersScheduledForDeletion->remove($this->ordersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOrder $order The ChildOrder object to add.
     */
    protected function doAddOrder(ChildOrder $order)
    {
        $this->collOrders[]= $order;
        $order->setPerson($this);
    }

    /**
     * @param  ChildOrder $order The ChildOrder object to remove.
     * @return $this|ChildPerson The current object (for fluent API support)
     */
    public function removeOrder(ChildOrder $order)
    {
        if ($this->getOrders()->contains($order)) {
            $pos = $this->collOrders->search($order);
            $this->collOrders->remove($pos);
            if (null === $this->ordersScheduledForDeletion) {
                $this->ordersScheduledForDeletion = clone $this->collOrders;
                $this->ordersScheduledForDeletion->clear();
            }
            $this->ordersScheduledForDeletion[]= clone $order;
            $order->setPerson(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Person is new, it will return
     * an empty collection; or if this Person has previously
     * been saved, it will retrieve related Orders from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Person.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrder[] List of ChildOrder objects
     */
    public function getOrdersJoinVoucher(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderQuery::create(null, $criteria);
        $query->joinWith('Voucher', $joinBehavior);

        return $this->getOrders($query, $con);
    }

    /**
     * Clears out the collRatings collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addRatings()
     */
    public function clearRatings()
    {
        $this->collRatings = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collRatings collection loaded partially.
     */
    public function resetPartialRatings($v = true)
    {
        $this->collRatingsPartial = $v;
    }

    /**
     * Initializes the collRatings collection.
     *
     * By default this just sets the collRatings collection to an empty array (like clearcollRatings());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initRatings($overrideExisting = true)
    {
        if (null !== $this->collRatings && !$overrideExisting) {
            return;
        }

        $collectionClassName = RatingTableMap::getTableMap()->getCollectionClassName();

        $this->collRatings = new $collectionClassName;
        $this->collRatings->setModel('\Rating');
    }

    /**
     * Gets an array of ChildRating objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPerson is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildRating[] List of ChildRating objects
     * @throws PropelException
     */
    public function getRatings(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collRatingsPartial && !$this->isNew();
        if (null === $this->collRatings || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collRatings) {
                // return empty collection
                $this->initRatings();
            } else {
                $collRatings = ChildRatingQuery::create(null, $criteria)
                    ->filterByPerson($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collRatingsPartial && count($collRatings)) {
                        $this->initRatings(false);

                        foreach ($collRatings as $obj) {
                            if (false == $this->collRatings->contains($obj)) {
                                $this->collRatings->append($obj);
                            }
                        }

                        $this->collRatingsPartial = true;
                    }

                    return $collRatings;
                }

                if ($partial && $this->collRatings) {
                    foreach ($this->collRatings as $obj) {
                        if ($obj->isNew()) {
                            $collRatings[] = $obj;
                        }
                    }
                }

                $this->collRatings = $collRatings;
                $this->collRatingsPartial = false;
            }
        }

        return $this->collRatings;
    }

    /**
     * Sets a collection of ChildRating objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $ratings A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPerson The current object (for fluent API support)
     */
    public function setRatings(Collection $ratings, ConnectionInterface $con = null)
    {
        /** @var ChildRating[] $ratingsToDelete */
        $ratingsToDelete = $this->getRatings(new Criteria(), $con)->diff($ratings);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->ratingsScheduledForDeletion = clone $ratingsToDelete;

        foreach ($ratingsToDelete as $ratingRemoved) {
            $ratingRemoved->setPerson(null);
        }

        $this->collRatings = null;
        foreach ($ratings as $rating) {
            $this->addRating($rating);
        }

        $this->collRatings = $ratings;
        $this->collRatingsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Rating objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Rating objects.
     * @throws PropelException
     */
    public function countRatings(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collRatingsPartial && !$this->isNew();
        if (null === $this->collRatings || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collRatings) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getRatings());
            }

            $query = ChildRatingQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPerson($this)
                ->count($con);
        }

        return count($this->collRatings);
    }

    /**
     * Method called to associate a ChildRating object to this object
     * through the ChildRating foreign key attribute.
     *
     * @param  ChildRating $l ChildRating
     * @return $this|\Person The current object (for fluent API support)
     */
    public function addRating(ChildRating $l)
    {
        if ($this->collRatings === null) {
            $this->initRatings();
            $this->collRatingsPartial = true;
        }

        if (!$this->collRatings->contains($l)) {
            $this->doAddRating($l);

            if ($this->ratingsScheduledForDeletion and $this->ratingsScheduledForDeletion->contains($l)) {
                $this->ratingsScheduledForDeletion->remove($this->ratingsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildRating $rating The ChildRating object to add.
     */
    protected function doAddRating(ChildRating $rating)
    {
        $this->collRatings[]= $rating;
        $rating->setPerson($this);
    }

    /**
     * @param  ChildRating $rating The ChildRating object to remove.
     * @return $this|ChildPerson The current object (for fluent API support)
     */
    public function removeRating(ChildRating $rating)
    {
        if ($this->getRatings()->contains($rating)) {
            $pos = $this->collRatings->search($rating);
            $this->collRatings->remove($pos);
            if (null === $this->ratingsScheduledForDeletion) {
                $this->ratingsScheduledForDeletion = clone $this->collRatings;
                $this->ratingsScheduledForDeletion->clear();
            }
            $this->ratingsScheduledForDeletion[]= clone $rating;
            $rating->setPerson(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Person is new, it will return
     * an empty collection; or if this Person has previously
     * been saved, it will retrieve related Ratings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Person.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildRating[] List of ChildRating objects
     */
    public function getRatingsJoinArticle(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildRatingQuery::create(null, $criteria);
        $query->joinWith('Article', $joinBehavior);

        return $this->getRatings($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aCity) {
            $this->aCity->removePerson($this);
        }
        if (null !== $this->aType) {
            $this->aType->removePerson($this);
        }
        $this->person_id = null;
        $this->firstname = null;
        $this->lastname = null;
        $this->email = null;
        $this->password = null;
        $this->birthdate = null;
        $this->street = null;
        $this->country = null;
        $this->zip_code = null;
        $this->type_id = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collBusinessCustomers) {
                foreach ($this->collBusinessCustomers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOrders) {
                foreach ($this->collOrders as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collRatings) {
                foreach ($this->collRatings as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBusinessCustomers = null;
        $this->collOrders = null;
        $this->collRatings = null;
        $this->aCity = null;
        $this->aType = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PersonTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
