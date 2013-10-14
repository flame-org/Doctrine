<?php
/**
 * Class DateFormat
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 14.10.13
 */
namespace Flame\Doctrine\StringFunctions;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;

class DateFormat extends FunctionNode
{

	/*
	 * holds the timestamp of the DATE_FORMAT DQL statement
	 * @var mixed
	 */
	protected $dateExpression;

	/**
	 * holds the '%format' parameter of the DATE_FORMAT DQL statement
	 * @var string
	 */
	protected $formatChar;

	/**
	 * @param \Doctrine\ORM\Query\SqlWalker $sqlWalker
	 *
	 * @return string
	 */
	public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
	{
		return 'DATE_FORMAT(' .
		$sqlWalker->walkArithmeticExpression($this->dateExpression) .
		','.
		$sqlWalker->walkStringPrimary($this->formatChar) .
		')';
	}

	/**
	 * @param \Doctrine\ORM\Query\Parser $parser
	 *
	 * @return void
	 */
	public function parse(\Doctrine\ORM\Query\Parser $parser)
	{
		$parser->match(Lexer::T_IDENTIFIER);
		$parser->match(Lexer::T_OPEN_PARENTHESIS);

		$this->dateExpression = $parser->ArithmeticExpression();
		$parser->match(Lexer::T_COMMA);


		$this->formatChar = $parser->StringPrimary();
		$parser->match(Lexer::T_CLOSE_PARENTHESIS);
	}
}