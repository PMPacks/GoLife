<?php

namespace MyPlot;

use pocketmine\item\Item;
use pocketmine\nbt\NBT;
use pocketmine\tile\Tile;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\nbt\tag\StringTag;
use pocketmine\nbt\tag\IntTag;
use pocketmine\math\Vector3;
use pocketmine\level\Level;
use pocketmine\level\Position;
use pocketmine\block\Block;
use pocketmine\level\generator\populator\Populator;
use pocketmine\utils\Random;
use pocketmine\level\generator\Generator;
use pocketmine\level\format\Chunk;
use pocketmine\level\ChunkManager;
use pocketmine\level\SimpleChunkManager;

class SkyBlockStructure extends Populator{
	public $generator = null;

	public function __construct(Generator $gen){
		$this->generator = $gen;
	}

	/**
	 *
	 * @param ChunkManager $level 
	 * @param Chunk $chunk 
	 * @param int $Xofchunk 
	 * @param int $Zofchunk 
	 */
	public static function placeObject(ChunkManager $level, $chunk, $Xofchunk, $Zofchunk){
		$vec = new Vector3($chunk->getX() * 16 + $Xofchunk, 0, $chunk->getZ() * 16 + $Zofchunk);
		$vec = $vec->subtract(7, 0, 1); // fix offset
$level->setBlockIdAt($vec->x + 5, 78, $vec->z + 5, 58); #bàn craft
		# Tầng 0
		$level->setBlockIdAt($vec->x + 7, 63, $vec->z + 7, 7);
		
		# Tầng 1
		$level->setBlockIdAt($vec->x + 7, 64, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 8, 64, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 8, 64, $vec->z + 8, 1);
		###
		
		# Tầng 2
		$level->setBlockIdAt($vec->x + 7, 65, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 6, 65, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 8, 65, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 9, 65, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 7, 65, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 7, 65, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 8, 65, $vec->z + 6, 1);
		###
		
		# Tầng 3
		$level->setBlockIdAt($vec->x + 7, 66, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 6, 66, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 8, 66, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 9, 66, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 7, 66, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 6, 66, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 8, 66, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 7, 66, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 8, 66, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 9, 66, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 10, 66, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 8, 66, $vec->z + 5, 1);
		###
		
		# Tầng 4
		$level->setBlockIdAt($vec->x + 7, 67, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 6, 67, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 5, 67, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 8, 67, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 9, 67, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 10, 67, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 7, 67, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 6, 67, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 5, 67, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 8, 67, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 9, 67, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 7, 67, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 8, 67, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 9, 67, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 10, 67, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 11, 67, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 6, 67, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 7, 67, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 8, 67, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 9, 67, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 10, 67, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 11, 67, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 6, 67, $vec->z + 5, 1);
		###
		
		# Tầng 5
		$level->setBlockIdAt($vec->x + 7, 68, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 8, 68, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 9, 68, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 10, 68, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 11, 68, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 6, 68, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 5, 68, $vec->z + 7, 1);
		
		$level->setBlockIdAt($vec->x + 7, 68, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 8, 68, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 9, 68, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 10, 68, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 6, 68, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 5, 68, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 4, 68, $vec->z + 8, 1);
		
		$level->setBlockIdAt($vec->x + 7, 68, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 8, 68, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 6, 68, $vec->z + 9, 1);
		
		$level->setBlockIdAt($vec->x + 7, 68, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 8, 68, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 9, 68, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 10, 68, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 11, 68, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 6, 68, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 5, 68, $vec->z + 6, 1);
		
		$level->setBlockIdAt($vec->x + 7, 68, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 8, 68, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 9, 68, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 10, 68, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 11, 68, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 12, 68, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 6, 68, $vec->z + 5, 1);
		
		$level->setBlockIdAt($vec->x + 7, 68, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 8, 68, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 9, 68, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 6, 68, $vec->z + 4, 1);
		###
		
		# Tầng 6
		$level->setBlockIdAt($vec->x + 7, 69, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 6, 69, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 5, 69, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 4, 69, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 8, 69, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 9, 69, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 10, 69, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 11, 69, $vec->z + 7, 1);
		
		$level->setBlockIdAt($vec->x + 7, 69, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 6, 69, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 5, 69, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 4, 69, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 8, 69, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 9, 69, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 10, 69, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 11, 69, $vec->z + 8, 1);
		
		$level->setBlockIdAt($vec->x + 7, 69, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 6, 69, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 5, 69, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 8, 69, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 9, 69, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 10, 69, $vec->z + 9, 1);
		
		$level->setBlockIdAt($vec->x + 7, 69, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 8, 69, $vec->z + 10, 1);
		
		$level->setBlockIdAt($vec->x + 7, 69, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 6, 69, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 5, 69, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 4, 69, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 8, 69, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 9, 69, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 10, 69, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 11, 69, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 12, 69, $vec->z + 6, 1);
		
		$level->setBlockIdAt($vec->x + 7, 69, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 6, 69, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 5, 69, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 4, 69, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 8, 69, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 9, 69, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 10, 69, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 11, 69, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 12, 69, $vec->z + 5, 1);
		
		$level->setBlockIdAt($vec->x + 7, 69, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 6, 69, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 5, 69, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 8, 69, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 9, 69, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 11, 69, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 10, 69, $vec->z + 4, 1);
		
		$level->setBlockIdAt($vec->x + 7, 69, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 8, 69, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 9, 69, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 10, 69, $vec->z + 3, 1);
		###
		
		# Tầng 7
		$level->setBlockIdAt($vec->x + 7, 70, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 6, 70, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 5, 70, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 4, 70, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 3, 70, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 8, 70, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 9, 70, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 10, 70, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 11, 70, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 12, 70, $vec->z + 7, 1);
		
		$level->setBlockIdAt($vec->x + 7, 70, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 6, 70, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 5, 70, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 4, 70, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 8, 70, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 9, 70, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 10, 70, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 11, 70, $vec->z + 8, 1);
		
		$level->setBlockIdAt($vec->x + 7, 70, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 6, 70, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 5, 70, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 4, 70, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 8, 70, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 9, 70, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 10, 70, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 11, 70, $vec->z + 9, 1);
		
		$level->setBlockIdAt($vec->x + 7, 70, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 8, 70, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 6, 70, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 9, 70, $vec->z + 10, 1);
		
		$level->setBlockIdAt($vec->x + 7, 70, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 6, 70, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 5, 70, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 4, 70, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 3, 70, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 8, 70, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 9, 70, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 10, 70, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 11, 70, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 12, 70, $vec->z + 6, 1);
		
		$level->setBlockIdAt($vec->x + 7, 70, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 6, 70, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 5, 70, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 4, 70, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 8, 70, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 9, 70, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 10, 70, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 11, 70, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 12, 70, $vec->z + 5, 1);
		
		$level->setBlockIdAt($vec->x + 7, 70, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 6, 70, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 5, 70, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 4, 70, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 8, 70, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 9, 70, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 11, 70, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 10, 70, $vec->z + 4, 1);
		
		$level->setBlockIdAt($vec->x + 7, 70, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 6, 70, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 8, 70, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 9, 70, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 10, 70, $vec->z + 3, 1);
		
		$level->setBlockIdAt($vec->x + 8, 70, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 9, 70, $vec->z + 2, 1);
		###
		
# Tầng 8
		$level->setBlockIdAt($vec->x + 7, 71, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 6, 71, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 5, 71, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 4, 71, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 3, 71, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 2, 71, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 8, 71, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 9, 71, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 10, 71, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 11, 71, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 12, 71, $vec->z + 7, 1);
		
		$level->setBlockIdAt($vec->x + 7, 71, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 6, 71, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 5, 71, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 4, 71, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 3, 71, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 8, 71, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 9, 71, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 10, 71, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 11, 71, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 12, 71, $vec->z + 8, 1);
		
		$level->setBlockIdAt($vec->x + 7, 71, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 6, 71, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 5, 71, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 4, 71, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 8, 71, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 9, 71, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 10, 71, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 11, 71, $vec->z + 9, 1);
		
		$level->setBlockIdAt($vec->x + 7, 71, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 5, 71, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 10, 71, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 8, 71, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 6, 71, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 9, 71, $vec->z + 10, 1);
		
		$level->setBlockIdAt($vec->x + 7, 71, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 8, 71, $vec->z + 11, 1);
		
		$level->setBlockIdAt($vec->x + 7, 71, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 6, 71, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 5, 71, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 4, 71, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 3, 71, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 8, 71, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 9, 71, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 10, 71, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 11, 71, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 12, 71, $vec->z + 6, 1);
		
		$level->setBlockIdAt($vec->x + 7, 71, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 6, 71, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 5, 71, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 4, 71, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 3, 71, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 8, 71, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 9, 71, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 10, 71, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 11, 71, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 12, 71, $vec->z + 5, 1);
		
		$level->setBlockIdAt($vec->x + 7, 71, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 6, 71, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 5, 71, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 4, 71, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 8, 71, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 9, 71, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 11, 71, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 10, 71, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 12, 71, $vec->z + 4, 1);
		
		$level->setBlockIdAt($vec->x + 7, 71, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 6, 71, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 5, 71, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 4, 71, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 8, 71, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 9, 71, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 10, 71, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 11, 71, $vec->z + 3, 1);
		
		$level->setBlockIdAt($vec->x + 7, 71, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 8, 71, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 9, 71, $vec->z + 2, 1);
		
		$level->setBlockIdAt($vec->x + 8, 71, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 9, 71, $vec->z + 1, 1);
		###
		
		# Tầng 9
		$level->setBlockIdAt($vec->x + 7, 72, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 6, 72, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 5, 72, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 4, 72, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 3, 72, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 2, 72, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 8, 72, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 9, 72, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 10, 72, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 11, 72, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 12, 72, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 13, 72, $vec->z + 7, 1);
		
		$level->setBlockIdAt($vec->x + 7, 72, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 6, 72, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 5, 72, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 4, 72, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 3, 72, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 8, 72, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 9, 72, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 10, 72, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 11, 72, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 12, 72, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 13, 72, $vec->z + 8, 1);
		
		$level->setBlockIdAt($vec->x + 7, 72, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 6, 72, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 5, 72, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 4, 72, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 3, 72, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 8, 72, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 9, 72, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 10, 72, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 11, 72, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 12, 72, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 13, 72, $vec->z + 9, 1);
		
		$level->setBlockIdAt($vec->x + 7, 72, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 6, 72, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 5, 72, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 4, 72, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 11, 72, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 10, 72, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 8, 72, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 9, 72, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 12, 72, $vec->z + 10, 1);
		
		$level->setBlockIdAt($vec->x + 7, 72, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 6, 72, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 8, 72, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 9, 72, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 10, 72, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 11, 72, $vec->z + 11, 1);
		
		$level->setBlockIdAt($vec->x + 9, 72, $vec->z + 12, 1);
		$level->setBlockIdAt($vec->x + 8, 72, $vec->z + 12, 1);
		
		$level->setBlockIdAt($vec->x + 7, 72, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 6, 72, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 5, 72, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 4, 72, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 3, 72, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 2, 72, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 8, 72, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 9, 72, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 10, 72, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 11, 72, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 12, 72, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 13, 72, $vec->z + 6, 1);
		
		$level->setBlockIdAt($vec->x + 7, 72, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 6, 72, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 5, 72, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 4, 72, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 3, 72, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 8, 72, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 9, 72, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 10, 72, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 11, 72, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 12, 72, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 13, 72, $vec->z + 5, 1);
		
		$level->setBlockIdAt($vec->x + 7, 72, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 6, 72, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 5, 72, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 4, 72, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 3, 72, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 8, 72, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 9, 72, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 11, 72, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 10, 72, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 12, 72, $vec->z + 4, 1);
		
		$level->setBlockIdAt($vec->x + 7, 72, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 6, 72, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 5, 72, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 4, 72, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 8, 72, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 9, 72, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 10, 72, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 11, 72, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 12, 72, $vec->z + 3, 1);
		
		$level->setBlockIdAt($vec->x + 7, 72, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 6, 72, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 8, 72, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 9, 72, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 10, 72, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 11, 72, $vec->z + 2, 1);
		
		$level->setBlockIdAt($vec->x + 8, 72, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 9, 72, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 10, 72, $vec->z + 1, 1);
		###
		
		# Tầng 10
		$level->setBlockIdAt($vec->x + 7, 73, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 6, 73, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 5, 73, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 4, 73, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 3, 73, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 2, 73, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 1, 73, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 8, 73, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 9, 73, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 10, 73, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 11, 73, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 12, 73, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 13, 73, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 14, 73, $vec->z + 7, 1);
		
		$level->setBlockIdAt($vec->x + 7, 73, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 6, 73, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 5, 73, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 4, 73, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 3, 73, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 8, 73, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 9, 73, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 10, 73, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 11, 73, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 12, 73, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 13, 73, $vec->z + 8, 1);
		
		$level->setBlockIdAt($vec->x + 7, 73, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 6, 73, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 5, 73, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 4, 73, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 3, 73, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 8, 73, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 9, 73, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 10, 73, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 11, 73, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 12, 73, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 13, 73, $vec->z + 9, 1);
		
		$level->setBlockIdAt($vec->x + 7, 73, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 6, 73, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 5, 73, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 4, 73, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 11, 73, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 10, 73, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 8, 73, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 9, 73, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 12, 73, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 13, 73, $vec->z + 10, 1);
		
		$level->setBlockIdAt($vec->x + 7, 73, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 6, 73, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 5, 73, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 8, 73, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 9, 73, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 10, 73, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 11, 73, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 12, 73, $vec->z + 11, 1);
		
		$level->setBlockIdAt($vec->x + 9, 73, $vec->z + 12, 1);
		$level->setBlockIdAt($vec->x + 8, 73, $vec->z + 12, 1);
		$level->setBlockIdAt($vec->x + 7, 73, $vec->z + 12, 1);
		$level->setBlockIdAt($vec->x + 10, 73, $vec->z + 12, 1);
		
		$level->setBlockIdAt($vec->x + 9, 73, $vec->z + 13, 1);
		
		$level->setBlockIdAt($vec->x + 7, 73, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 6, 73, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 5, 73, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 4, 73, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 3, 73, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 2, 73, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 8, 73, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 9, 73, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 10, 73, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 11, 73, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 12, 73, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 13, 73, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 14, 73, $vec->z + 6, 1);
		
		$level->setBlockIdAt($vec->x + 7, 73, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 6, 73, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 5, 73, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 4, 73, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 3, 73, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 2, 73, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 8, 73, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 9, 73, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 10, 73, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 11, 73, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 12, 73, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 13, 73, $vec->z + 5, 1);
		
		$level->setBlockIdAt($vec->x + 7, 73, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 6, 73, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 5, 73, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 4, 73, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 3, 73, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 8, 73, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 9, 73, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 11, 73, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 10, 73, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 12, 73, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 13, 73, $vec->z + 4, 1);
		
		$level->setBlockIdAt($vec->x + 7, 73, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 6, 73, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 5, 73, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 4, 73, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 8, 73, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 9, 73, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 10, 73, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 11, 73, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 12, 73, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 13, 73, $vec->z + 3, 1);
		
		$level->setBlockIdAt($vec->x + 7, 73, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 6, 73, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 5, 73, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 8, 73, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 9, 73, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 10, 73, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 11, 73, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 12, 73, $vec->z + 2, 1);
		
		$level->setBlockIdAt($vec->x + 7, 73, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 8, 73, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 9, 73, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 10, 73, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 11, 73, $vec->z + 1, 1);
		
		$level->setBlockIdAt($vec->x + 9, 73, $vec->z + 0, 1);
		$level->setBlockIdAt($vec->x + 10, 73, $vec->z + 0, 1);
		###
		
		# Tầng 11
		$level->setBlockIdAt($vec->x + 7, 74, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 6, 74, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 5, 74, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 4, 74, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 3, 74, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 2, 74, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 1, 74, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 8, 74, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 9, 74, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 10, 74, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 11, 74, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 12, 74, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 13, 74, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 14, 74, $vec->z + 7, 1);
		
		$level->setBlockIdAt($vec->x + 7, 74, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 6, 74, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 5, 74, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 4, 74, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 3, 74, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 2, 74, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 8, 74, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 9, 74, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 10, 74, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 11, 74, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 12, 74, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 13, 74, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 14, 74, $vec->z + 8, 1);
		
		$level->setBlockIdAt($vec->x + 7, 74, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 6, 74, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 5, 74, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 4, 74, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 3, 74, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 8, 74, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 9, 74, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 10, 74, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 11, 74, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 12, 74, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 13, 74, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 14, 74, $vec->z + 9, 1);
		
		$level->setBlockIdAt($vec->x + 7, 74, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 6, 74, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 5, 74, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 4, 74, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 11, 74, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 10, 74, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 8, 74, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 9, 74, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 12, 74, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 13, 74, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 14, 74, $vec->z + 10, 1);
		
		$level->setBlockIdAt($vec->x + 7, 74, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 6, 74, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 5, 74, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 4, 74, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 8, 74, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 9, 74, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 10, 74, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 11, 74, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 12, 74, $vec->z + 11, 1);
		
		$level->setBlockIdAt($vec->x + 7, 74, $vec->z + 12, 1);
		$level->setBlockIdAt($vec->x + 6, 74, $vec->z + 12, 1);
		$level->setBlockIdAt($vec->x + 8, 74, $vec->z + 12, 1);
		$level->setBlockIdAt($vec->x + 9, 74, $vec->z + 12, 1);
		$level->setBlockIdAt($vec->x + 10, 74, $vec->z + 12, 1);
		$level->setBlockIdAt($vec->x + 11, 74, $vec->z + 12, 1);
		
		$level->setBlockIdAt($vec->x + 9, 74, $vec->z + 13, 1);
		$level->setBlockIdAt($vec->x + 8, 74, $vec->z + 13, 1);
		$level->setBlockIdAt($vec->x + 10, 74, $vec->z + 13, 1);
		
		$level->setBlockIdAt($vec->x + 7, 74, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 6, 74, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 5, 74, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 4, 74, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 3, 74, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 2, 74, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 1, 74, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 8, 74, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 9, 74, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 10, 74, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 11, 74, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 12, 74, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 13, 74, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 14, 74, $vec->z + 6, 1);
		
		$level->setBlockIdAt($vec->x + 7, 74, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 6, 74, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 5, 74, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 4, 74, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 3, 74, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 2, 74, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 8, 74, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 9, 74, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 10, 74, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 11, 74, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 12, 74, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 13, 74, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 14, 74, $vec->z + 5, 1);
		
		$level->setBlockIdAt($vec->x + 7, 74, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 6, 74, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 5, 74, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 4, 74, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 3, 74, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 2, 74, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 8, 74, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 9, 74, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 11, 74, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 10, 74, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 12, 74, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 13, 74, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 14, 74, $vec->z + 4, 1);
		
		$level->setBlockIdAt($vec->x + 7, 74, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 6, 74, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 5, 74, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 4, 74, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 3, 74, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 8, 74, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 9, 74, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 10, 74, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 11, 74, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 12, 74, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 13, 74, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 14, 74, $vec->z + 3, 1);
		
		$level->setBlockIdAt($vec->x + 7, 74, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 6, 74, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 5, 74, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 4, 74, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 8, 74, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 9, 74, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 10, 74, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 11, 74, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 12, 74, $vec->z + 2, 1);
		
		$level->setBlockIdAt($vec->x + 7, 74, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 6, 74, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 5, 74, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 8, 74, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 9, 74, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 10, 74, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 11, 74, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 12, 74, $vec->z + 1, 1);
		
		$level->setBlockIdAt($vec->x + 8, 74, $vec->z + 0, 1);	
		$level->setBlockIdAt($vec->x + 9, 74, $vec->z + 0, 1);
		$level->setBlockIdAt($vec->x + 10, 74, $vec->z + 0, 1);
		$level->setBlockIdAt($vec->x + 11, 74, $vec->z + 0, 1);
		$level->setBlockIdAt($vec->x + 12, 74, $vec->z + 0, 1);
		###
		
		# Tầng 12
		$level->setBlockIdAt($vec->x + 7, 74, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 6, 74, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 5, 74, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 4, 74, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 3, 74, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 2, 74, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 1, 74, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 8, 74, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 9, 74, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 10, 74, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 11, 74, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 12, 74, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 13, 74, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 14, 74, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 15, 74, $vec->z + 7, 1);
		
		$level->setBlockIdAt($vec->x + 7, 74, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 6, 74, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 5, 74, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 4, 74, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 3, 74, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 2, 74, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 8, 74, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 9, 74, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 10, 74, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 11, 74, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 12, 74, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 13, 74, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 14, 74, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 15, 74, $vec->z + 8, 1);
		
		$level->setBlockIdAt($vec->x + 7, 74, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 6, 74, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 5, 74, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 4, 74, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 3, 74, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 8, 74, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 9, 74, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 10, 74, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 11, 74, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 12, 74, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 13, 74, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 14, 74, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 15, 74, $vec->z + 9, 1);
		
		$level->setBlockIdAt($vec->x + 7, 74, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 6, 74, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 5, 74, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 4, 74, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 3, 74, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 11, 74, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 10, 74, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 8, 74, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 9, 74, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 12, 74, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 13, 74, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 14, 74, $vec->z + 10, 1);
		
		$level->setBlockIdAt($vec->x + 7, 74, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 6, 74, $vec->z + 11, 12);
		$level->setBlockIdAt($vec->x + 5, 74, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 4, 74, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 8, 74, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 9, 74, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 10, 74, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 11, 74, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 12, 74, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 13, 74, $vec->z + 11, 1);
		
		$level->setBlockIdAt($vec->x + 7, 74, $vec->z + 12, 1);
		$level->setBlockIdAt($vec->x + 6, 74, $vec->z + 12, 12);
		$level->setBlockIdAt($vec->x + 5, 74, $vec->z + 12, 1);
		$level->setBlockIdAt($vec->x + 8, 74, $vec->z + 12, 1);
		$level->setBlockIdAt($vec->x + 9, 74, $vec->z + 12, 1);
		$level->setBlockIdAt($vec->x + 10, 74, $vec->z + 12, 1);
		$level->setBlockIdAt($vec->x + 11, 74, $vec->z + 12, 1);
		$level->setBlockIdAt($vec->x + 12, 74, $vec->z + 12, 1);
		
		$level->setBlockIdAt($vec->x + 7, 74, $vec->z + 13, 1);
		$level->setBlockIdAt($vec->x + 11, 74, $vec->z + 13, 1);
		$level->setBlockIdAt($vec->x + 9, 74, $vec->z + 13, 1);
		$level->setBlockIdAt($vec->x + 8, 74, $vec->z + 13, 1);
		$level->setBlockIdAt($vec->x + 10, 74, $vec->z + 13, 1);
		
		$level->setBlockIdAt($vec->x + 9, 74, $vec->z + 14, 1);
		
		$level->setBlockIdAt($vec->x + 7, 74, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 6, 74, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 5, 74, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 4, 74, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 3, 74, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 2, 74, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 1, 74, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 8, 74, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 9, 74, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 10, 74, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 11, 74, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 12, 74, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 13, 74, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 14, 74, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 15, 74, $vec->z + 6, 1);
		
		$level->setBlockIdAt($vec->x + 7, 74, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 6, 74, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 5, 74, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 4, 74, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 3, 74, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 2, 74, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 1, 74, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 8, 74, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 9, 74, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 10, 74, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 11, 74, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 12, 74, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 13, 74, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 14, 74, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 15, 74, $vec->z + 5, 1);
		
		$level->setBlockIdAt($vec->x + 7, 74, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 6, 74, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 5, 74, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 4, 74, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 3, 74, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 2, 74, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 8, 74, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 9, 74, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 11, 74, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 10, 74, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 12, 74, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 13, 74, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 14, 74, $vec->z + 4, 1);
		
		$level->setBlockIdAt($vec->x + 7, 74, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 6, 74, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 5, 74, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 4, 74, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 3, 74, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 2, 74, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 8, 74, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 9, 74, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 10, 74, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 11, 74, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 12, 74, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 13, 74, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 14, 74, $vec->z + 3, 1);
		
		$level->setBlockIdAt($vec->x + 7, 74, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 6, 74, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 5, 74, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 4, 74, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 3, 74, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 8, 74, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 9, 74, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 10, 74, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 11, 74, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 12, 74, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 13, 74, $vec->z + 2, 1);
		
		$level->setBlockIdAt($vec->x + 7, 74, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 6, 74, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 5, 74, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 4, 74, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 8, 74, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 9, 74, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 10, 74, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 11, 74, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 12, 74, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 13, 74, $vec->z + 1, 1);
		
		$level->setBlockIdAt($vec->x + 7, 74, $vec->z + 0, 1);
		$level->setBlockIdAt($vec->x + 8, 74, $vec->z + 0, 1);	
		$level->setBlockIdAt($vec->x + 9, 74, $vec->z + 0, 1);
		$level->setBlockIdAt($vec->x + 10, 74, $vec->z + 0, 1);
		$level->setBlockIdAt($vec->x + 11, 74, $vec->z + 0, 1);
		$level->setBlockIdAt($vec->x + 12, 74, $vec->z + 0, 1);
		
		$level->setBlockIdAt($vec->x + 8, 74, $vec->z - 1, 1);
		$level->setBlockIdAt($vec->x + 9, 74, $vec->z - 1, 1);
		###
		
		# Tầng 13
		$level->setBlockIdAt($vec->x + 7, 75, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 6, 75, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 5, 75, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 4, 75, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 3, 75, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 2, 75, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 1, 75, $vec->z + 7, 2);
		$level->setBlockIdAt($vec->x + 8, 75, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 9, 75, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 10, 75, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 11, 75, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 12, 75, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 13, 75, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 14, 75, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 15, 75, $vec->z + 7, 1);
		$level->setBlockIdAt($vec->x + 16, 75, $vec->z + 7, 1);
		
		$level->setBlockIdAt($vec->x + 7, 75, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 6, 75, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 5, 75, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 4, 75, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 3, 75, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 2, 75, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 1, 75, $vec->z + 8, 2);
		$level->setBlockIdAt($vec->x + 8, 75, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 9, 75, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 10, 75, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 11, 75, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 12, 75, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 13, 75, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 14, 75, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 15, 75, $vec->z + 8, 1);
		$level->setBlockIdAt($vec->x + 16, 75, $vec->z + 8, 1);
		
		$level->setBlockIdAt($vec->x + 7, 75, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 6, 75, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 5, 75, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 4, 75, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 3, 75, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 2, 75, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 8, 75, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 9, 75, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 10, 75, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 11, 75, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 12, 75, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 13, 75, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 14, 75, $vec->z + 9, 1);
		$level->setBlockIdAt($vec->x + 15, 75, $vec->z + 9, 1);
		
		$level->setBlockIdAt($vec->x + 7, 75, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 6, 75, $vec->z + 10, 12);
		$level->setBlockIdAt($vec->x + 5, 75, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 4, 75, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 3, 75, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 11, 75, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 10, 75, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 8, 75, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 9, 75, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 12, 75, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 13, 75, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 14, 75, $vec->z + 10, 1);
		$level->setBlockIdAt($vec->x + 15, 75, $vec->z + 10, 1);
		
		$level->setBlockIdAt($vec->x + 7, 75, $vec->z + 11, 12);
		$level->setBlockIdAt($vec->x + 6, 75, $vec->z + 11, 8);
		$level->setBlockIdAt($vec->x + 5, 75, $vec->z + 11, 12);
		$level->setBlockIdAt($vec->x + 4, 75, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 3, 75, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 8, 75, $vec->z + 11, 12);
		$level->setBlockIdAt($vec->x + 9, 75, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 10, 75, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 11, 75, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 12, 75, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 13, 75, $vec->z + 11, 1);
		$level->setBlockIdAt($vec->x + 14, 75, $vec->z + 11, 1);
		
		$level->setBlockIdAt($vec->x + 7, 75, $vec->z + 12, 12);
		$level->setBlockIdAt($vec->x + 6, 75, $vec->z + 12, 8);
		$level->setBlockIdAt($vec->x + 5, 75, $vec->z + 12, 1);
		$level->setBlockIdAt($vec->x + 4, 75, $vec->z + 12, 1);
		$level->setBlockIdAt($vec->x + 8, 75, $vec->z + 12, 12);
		$level->setBlockIdAt($vec->x + 9, 75, $vec->z + 12, 1);
		$level->setBlockIdAt($vec->x + 10, 75, $vec->z + 12, 1);
		$level->setBlockIdAt($vec->x + 11, 75, $vec->z + 12, 1);
		$level->setBlockIdAt($vec->x + 12, 75, $vec->z + 12, 1);
		
		$level->setBlockIdAt($vec->x + 7, 75, $vec->z + 13, 1);
		$level->setBlockIdAt($vec->x + 11, 75, $vec->z + 13, 1);
		$level->setBlockIdAt($vec->x + 9, 75, $vec->z + 13, 1);
		$level->setBlockIdAt($vec->x + 8, 75, $vec->z + 13, 1);
		$level->setBlockIdAt($vec->x + 10, 75, $vec->z + 13, 1);
		$level->setBlockIdAt($vec->x + 12, 75, $vec->z + 13, 2);
		
		$level->setBlockIdAt($vec->x + 9, 75, $vec->z + 14, 1);
		
		$level->setBlockIdAt($vec->x + 7, 75, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 6, 75, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 5, 75, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 4, 75, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 3, 75, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 2, 75, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 1, 75, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 8, 75, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 9, 75, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 10, 75, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 11, 75, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 12, 75, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 13, 75, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 14, 75, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 15, 75, $vec->z + 6, 1);
		$level->setBlockIdAt($vec->x + 16, 75, $vec->z + 6, 1);
		
		$level->setBlockIdAt($vec->x + 7, 75, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 6, 75, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 5, 75, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 4, 75, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 3, 75, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 2, 75, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 1, 75, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 8, 75, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 9, 75, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 10, 75, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 11, 75, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 12, 75, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 13, 75, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 14, 75, $vec->z + 5, 1);
		$level->setBlockIdAt($vec->x + 15, 75, $vec->z + 5, 1);
		
		$level->setBlockIdAt($vec->x + 7, 75, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 6, 75, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 5, 75, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 4, 75, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 3, 75, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 2, 75, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 1, 75, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 8, 75, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 9, 75, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 11, 75, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 10, 75, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 12, 75, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 13, 75, $vec->z + 4, 1);
		$level->setBlockIdAt($vec->x + 14, 75, $vec->z + 4, 1);
		
		$level->setBlockIdAt($vec->x + 7, 75, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 6, 75, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 5, 75, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 4, 75, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 3, 75, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 2, 75, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 8, 75, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 9, 75, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 10, 75, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 11, 75, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 12, 75, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 13, 75, $vec->z + 3, 1);
		$level->setBlockIdAt($vec->x + 14, 75, $vec->z + 3, 1);
		
		$level->setBlockIdAt($vec->x + 7, 75, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 6, 75, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 5, 75, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 4, 75, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 3, 75, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 2, 75, $vec->z + 2, 2);
		$level->setBlockIdAt($vec->x + 8, 75, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 9, 75, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 10, 75, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 11, 75, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 12, 75, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 13, 75, $vec->z + 2, 1);
		$level->setBlockIdAt($vec->x + 14, 75, $vec->z + 2, 1);
		
		$level->setBlockIdAt($vec->x + 7, 75, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 6, 75, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 5, 75, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 4, 75, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 8, 75, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 9, 75, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 10, 75, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 11, 75, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 12, 75, $vec->z + 1, 1);
		$level->setBlockIdAt($vec->x + 13, 75, $vec->z + 1, 1);
		
		$level->setBlockIdAt($vec->x + 7, 75, $vec->z + 0, 1);
		$level->setBlockIdAt($vec->x + 6, 75, $vec->z + 0, 1);
		$level->setBlockIdAt($vec->x + 5, 75, $vec->z + 0, 1);
		$level->setBlockIdAt($vec->x + 8, 75, $vec->z + 0, 1);	
		$level->setBlockIdAt($vec->x + 9, 75, $vec->z + 0, 1);
		$level->setBlockIdAt($vec->x + 10, 75, $vec->z + 0, 1);
		$level->setBlockIdAt($vec->x + 11, 75, $vec->z + 0, 1);
		$level->setBlockIdAt($vec->x + 12, 75, $vec->z + 0, 1);
		$level->setBlockIdAt($vec->x + 13, 75, $vec->z + 0, 1);
		
		$level->setBlockIdAt($vec->x + 7, 75, $vec->z - 1, 1);
		$level->setBlockIdAt($vec->x + 6, 75, $vec->z - 1, 2);
		$level->setBlockIdAt($vec->x + 8, 75, $vec->z - 1, 1);
		$level->setBlockIdAt($vec->x + 9, 75, $vec->z - 1, 1);
		$level->setBlockIdAt($vec->x + 10, 75, $vec->z - 1, 1);
		$level->setBlockIdAt($vec->x + 11, 75, $vec->z - 1, 1);
		###
		
		# Tầng 14
		$level->setBlockIdAt($vec->x + 7, 76, $vec->z + 7, 3); #day là id 3
		$level->setBlockIdAt($vec->x + 6, 76, $vec->z + 7, 3);
		$level->setBlockIdAt($vec->x + 5, 76, $vec->z + 7, 3);
		$level->setBlockIdAt($vec->x + 4, 76, $vec->z + 7, 3);
		$level->setBlockIdAt($vec->x + 3, 76, $vec->z + 7, 3);
		$level->setBlockIdAt($vec->x + 2, 76, $vec->z + 7, 2);
		$level->setBlockIdAt($vec->x + 8, 76, $vec->z + 7, 3);
		$level->setBlockIdAt($vec->x + 9, 76, $vec->z + 7, 3);
		$level->setBlockIdAt($vec->x + 10, 76, $vec->z + 7, 3);
		$level->setBlockIdAt($vec->x + 11, 76, $vec->z + 7, 3);
		$level->setBlockIdAt($vec->x + 12, 76, $vec->z + 7, 3);
		$level->setBlockIdAt($vec->x + 13, 76, $vec->z + 7, 3);
		$level->setBlockIdAt($vec->x + 14, 76, $vec->z + 7, 3);
		$level->setBlockIdAt($vec->x + 15, 76, $vec->z + 7, 3);
		$level->setBlockIdAt($vec->x + 16, 76, $vec->z + 7, 3);
		$level->setBlockIdAt($vec->x + 17, 76, $vec->z + 7, 2);
		
		$level->setBlockIdAt($vec->x + 7, 76, $vec->z + 8, 3);
		$level->setBlockIdAt($vec->x + 6, 76, $vec->z + 8, 3);
		$level->setBlockIdAt($vec->x + 5, 76, $vec->z + 8, 3);
		$level->setBlockIdAt($vec->x + 4, 76, $vec->z + 8, 3);
		$level->setBlockIdAt($vec->x + 3, 76, $vec->z + 8, 3);
		$level->setBlockIdAt($vec->x + 2, 76, $vec->z + 8, 3);
		$level->setBlockIdAt($vec->x + 8, 76, $vec->z + 8, 3);
		$level->setBlockIdAt($vec->x + 9, 76, $vec->z + 8, 3);
		$level->setBlockIdAt($vec->x + 10, 76, $vec->z + 8, 3);
		$level->setBlockIdAt($vec->x + 11, 76, $vec->z + 8, 3);
		$level->setBlockIdAt($vec->x + 12, 76, $vec->z + 8, 3);
		$level->setBlockIdAt($vec->x + 13, 76, $vec->z + 8, 3);
		$level->setBlockIdAt($vec->x + 14, 76, $vec->z + 8, 3);
		$level->setBlockIdAt($vec->x + 15, 76, $vec->z + 8, 3);
		$level->setBlockIdAt($vec->x + 16, 76, $vec->z + 8, 3);
		$level->setBlockIdAt($vec->x + 17, 76, $vec->z + 8, 3);
		
		$level->setBlockIdAt($vec->x + 7, 76, $vec->z + 9, 3);
		$level->setBlockIdAt($vec->x + 6, 76, $vec->z + 9, 12);
		$level->setBlockIdAt($vec->x + 5, 76, $vec->z + 9, 3);
		$level->setBlockIdAt($vec->x + 4, 76, $vec->z + 9, 3);
		$level->setBlockIdAt($vec->x + 3, 76, $vec->z + 9, 3);
		$level->setBlockIdAt($vec->x + 2, 76, $vec->z + 9, 3);
		$level->setBlockIdAt($vec->x + 1, 76, $vec->z + 9, 2);
		$level->setBlockIdAt($vec->x + 8, 76, $vec->z + 9, 3);
		$level->setBlockIdAt($vec->x + 9, 76, $vec->z + 9, 3);
		$level->setBlockIdAt($vec->x + 10, 76, $vec->z + 9, 3);
		$level->setBlockIdAt($vec->x + 11, 76, $vec->z + 9, 3);
		$level->setBlockIdAt($vec->x + 12, 76, $vec->z + 9, 3);
		$level->setBlockIdAt($vec->x + 13, 76, $vec->z + 9, 3);
		$level->setBlockIdAt($vec->x + 14, 76, $vec->z + 9, 3);
		$level->setBlockIdAt($vec->x + 15, 76, $vec->z + 9, 3);
		$level->setBlockIdAt($vec->x + 16, 76, $vec->z + 9, 3);
		$level->setBlockIdAt($vec->x + 17, 76, $vec->z + 9, 2);
		
		$level->setBlockIdAt($vec->x + 7, 76, $vec->z + 10, 12);
		$level->setBlockIdAt($vec->x + 6, 76, $vec->z + 10, 8);
		$level->setBlockIdAt($vec->x + 5, 76, $vec->z + 10, 12);
		$level->setBlockIdAt($vec->x + 4, 76, $vec->z + 10, 3);
		$level->setBlockIdAt($vec->x + 3, 76, $vec->z + 10, 3);
		$level->setBlockIdAt($vec->x + 2, 76, $vec->z + 10, 2);
		$level->setBlockIdAt($vec->x + 11, 76, $vec->z + 10, 3);
		$level->setBlockIdAt($vec->x + 10, 76, $vec->z + 10, 3);
		$level->setBlockIdAt($vec->x + 8, 76, $vec->z + 10, 3);
		$level->setBlockIdAt($vec->x + 9, 76, $vec->z + 10, 3);
		$level->setBlockIdAt($vec->x + 12, 76, $vec->z + 10, 3);
		$level->setBlockIdAt($vec->x + 13, 76, $vec->z + 10, 3);
		$level->setBlockIdAt($vec->x + 14, 76, $vec->z + 10, 3);
		$level->setBlockIdAt($vec->x + 15, 76, $vec->z + 10, 2);
		
		$level->setBlockIdAt($vec->x + 7, 76, $vec->z + 11, 8);
		$level->setBlockIdAt($vec->x + 6, 76, $vec->z + 11, 8);
		$level->setBlockIdAt($vec->x + 5, 76, $vec->z + 11, 8);
		$level->setBlockIdAt($vec->x + 4, 76, $vec->z + 11, 12);
		$level->setBlockIdAt($vec->x + 3, 76, $vec->z + 11, 2);
		$level->setBlockIdAt($vec->x + 2, 76, $vec->z + 11, 2);
		$level->setBlockIdAt($vec->x + 8, 76, $vec->z + 11, 8);
		$level->setBlockIdAt($vec->x + 9, 76, $vec->z + 11, 3);
		$level->setBlockIdAt($vec->x + 10, 76, $vec->z + 11, 3);
		$level->setBlockIdAt($vec->x + 11, 76, $vec->z + 11, 3);
		$level->setBlockIdAt($vec->x + 12, 76, $vec->z + 11, 3);
		$level->setBlockIdAt($vec->x + 13, 76, $vec->z + 11, 3);
		$level->setBlockIdAt($vec->x + 14, 76, $vec->z + 11, 2);
		
		$level->setBlockIdAt($vec->x + 7, 76, $vec->z + 12, 8);
		$level->setBlockIdAt($vec->x + 6, 76, $vec->z + 12, 8);
		$level->setBlockIdAt($vec->x + 5, 76, $vec->z + 12, 2);
		$level->setBlockIdAt($vec->x + 4, 76, $vec->z + 12, 2);
		$level->setBlockIdAt($vec->x + 8, 76, $vec->z + 12, 8);
		$level->setBlockIdAt($vec->x + 9, 76, $vec->z + 12, 3);
		$level->setBlockIdAt($vec->x + 10, 76, $vec->z + 12, 3);
		$level->setBlockIdAt($vec->x + 11, 76, $vec->z + 12, 3);
		$level->setBlockIdAt($vec->x + 12, 76, $vec->z + 12, 2);
		
		$level->setBlockIdAt($vec->x + 7, 76, $vec->z + 13, 2);
		
		$level->setBlockIdAt($vec->x + 6, 76, $vec->z + 13, 9);
		$level->setBlockDataAt($vec->x + 6, 76, $vec->z + 13, 1);
		
		$level->setBlockIdAt($vec->x + 11, 76, $vec->z + 13, 2);
		$level->setBlockIdAt($vec->x + 9, 76, $vec->z + 13, 2);
		$level->setBlockIdAt($vec->x + 8, 76, $vec->z + 13, 2);
		$level->setBlockIdAt($vec->x + 10, 76, $vec->z + 13, 3);
		
		$level->setBlockIdAt($vec->x + 9, 76, $vec->z + 14, 1);
		
		$level->setBlockIdAt($vec->x + 7, 76, $vec->z + 6, 3);
		$level->setBlockIdAt($vec->x + 6, 76, $vec->z + 6, 3);
		$level->setBlockIdAt($vec->x + 5, 76, $vec->z + 6, 3);
		$level->setBlockIdAt($vec->x + 4, 76, $vec->z + 6, 3);
		$level->setBlockIdAt($vec->x + 3, 76, $vec->z + 6, 3);
		$level->setBlockIdAt($vec->x + 2, 76, $vec->z + 6, 2);
		$level->setBlockIdAt($vec->x + 1, 76, $vec->z + 6, 2);
		$level->setBlockIdAt($vec->x + 8, 76, $vec->z + 6, 3);
		$level->setBlockIdAt($vec->x + 9, 76, $vec->z + 6, 3);
		$level->setBlockIdAt($vec->x + 10, 76, $vec->z + 6, 3);
		$level->setBlockIdAt($vec->x + 11, 76, $vec->z + 6, 3);
		$level->setBlockIdAt($vec->x + 12, 76, $vec->z + 6, 3);
		$level->setBlockIdAt($vec->x + 13, 76, $vec->z + 6, 3);
		$level->setBlockIdAt($vec->x + 14, 76, $vec->z + 6, 3);
		$level->setBlockIdAt($vec->x + 15, 76, $vec->z + 6, 3);
		$level->setBlockIdAt($vec->x + 16, 76, $vec->z + 6, 2);
		
		$level->setBlockIdAt($vec->x + 7, 76, $vec->z + 5, 3);
		$level->setBlockIdAt($vec->x + 6, 76, $vec->z + 5, 3);
		$level->setBlockIdAt($vec->x + 5, 76, $vec->z + 5, 3);
		$level->setBlockIdAt($vec->x + 4, 76, $vec->z + 5, 3);
		$level->setBlockIdAt($vec->x + 3, 76, $vec->z + 5, 3);
		$level->setBlockIdAt($vec->x + 2, 76, $vec->z + 5, 3);
		$level->setBlockIdAt($vec->x + 1, 76, $vec->z + 5, 2);
		$level->setBlockIdAt($vec->x + 8, 76, $vec->z + 5, 3);
		$level->setBlockIdAt($vec->x + 9, 76, $vec->z + 5, 3);
		$level->setBlockIdAt($vec->x + 10, 76, $vec->z + 5, 3);
		$level->setBlockIdAt($vec->x + 11, 76, $vec->z + 5, 3);
		$level->setBlockIdAt($vec->x + 12, 76, $vec->z + 5, 3);
		$level->setBlockIdAt($vec->x + 13, 76, $vec->z + 5, 3);
		$level->setBlockIdAt($vec->x + 14, 76, $vec->z + 5, 3);
		$level->setBlockIdAt($vec->x + 15, 76, $vec->z + 5, 3);
		$level->setBlockIdAt($vec->x + 16, 76, $vec->z + 5, 2);
		
		$level->setBlockIdAt($vec->x + 7, 76, $vec->z + 4, 3);
		$level->setBlockIdAt($vec->x + 6, 76, $vec->z + 4, 3);
		$level->setBlockIdAt($vec->x + 5, 76, $vec->z + 4, 3);
		$level->setBlockIdAt($vec->x + 4, 76, $vec->z + 4, 3);
		$level->setBlockIdAt($vec->x + 3, 76, $vec->z + 4, 3);
		$level->setBlockIdAt($vec->x + 2, 76, $vec->z + 4, 3);
		$level->setBlockIdAt($vec->x + 1, 76, $vec->z + 4, 2);
		$level->setBlockIdAt($vec->x + 8, 76, $vec->z + 4, 3);
		$level->setBlockIdAt($vec->x + 9, 76, $vec->z + 4, 3);
		$level->setBlockIdAt($vec->x + 11, 76, $vec->z + 4, 3);
		$level->setBlockIdAt($vec->x + 10, 76, $vec->z + 4, 3);
		$level->setBlockIdAt($vec->x + 12, 76, $vec->z + 4, 3);
		$level->setBlockIdAt($vec->x + 13, 76, $vec->z + 4, 3);
		$level->setBlockIdAt($vec->x + 14, 76, $vec->z + 4, 3);
		$level->setBlockIdAt($vec->x + 15, 76, $vec->z + 4, 2);
		
		$level->setBlockIdAt($vec->x + 7, 76, $vec->z + 3, 3);
		$level->setBlockIdAt($vec->x + 6, 76, $vec->z + 3, 3);
		$level->setBlockIdAt($vec->x + 5, 76, $vec->z + 3, 3);
		$level->setBlockIdAt($vec->x + 4, 76, $vec->z + 3, 3);
		$level->setBlockIdAt($vec->x + 3, 76, $vec->z + 3, 3);
		$level->setBlockIdAt($vec->x + 2, 76, $vec->z + 3, 2);
		$level->setBlockIdAt($vec->x + 8, 76, $vec->z + 3, 3);
		$level->setBlockIdAt($vec->x + 9, 76, $vec->z + 3, 3);
		$level->setBlockIdAt($vec->x + 10, 76, $vec->z + 3, 3);
		$level->setBlockIdAt($vec->x + 11, 76, $vec->z + 3, 3);
		$level->setBlockIdAt($vec->x + 12, 76, $vec->z + 3, 3);
		$level->setBlockIdAt($vec->x + 13, 76, $vec->z + 3, 3);
		$level->setBlockIdAt($vec->x + 14, 76, $vec->z + 3, 3);
		$level->setBlockIdAt($vec->x + 15, 76, $vec->z + 3, 2);
		
		$level->setBlockIdAt($vec->x + 7, 76, $vec->z + 2, 3);
		$level->setBlockIdAt($vec->x + 6, 76, $vec->z + 2, 3);
		$level->setBlockIdAt($vec->x + 5, 76, $vec->z + 2, 3);
		$level->setBlockIdAt($vec->x + 4, 76, $vec->z + 2, 3);
		$level->setBlockIdAt($vec->x + 3, 76, $vec->z + 2, 2);
		$level->setBlockIdAt($vec->x + 8, 76, $vec->z + 2, 3);
		$level->setBlockIdAt($vec->x + 9, 76, $vec->z + 2, 3);
		$level->setBlockIdAt($vec->x + 10, 76, $vec->z + 2, 3);
		$level->setBlockIdAt($vec->x + 11, 76, $vec->z + 2, 3);
		$level->setBlockIdAt($vec->x + 12, 76, $vec->z + 2, 3);
		$level->setBlockIdAt($vec->x + 13, 76, $vec->z + 2, 3);
		$level->setBlockIdAt($vec->x + 14, 76, $vec->z + 2, 2);
		
		$level->setBlockIdAt($vec->x + 7, 76, $vec->z + 1, 3);
		$level->setBlockIdAt($vec->x + 6, 76, $vec->z + 1, 3);
		$level->setBlockIdAt($vec->x + 5, 76, $vec->z + 1, 2);
		$level->setBlockIdAt($vec->x + 4, 76, $vec->z + 1, 2);
		$level->setBlockIdAt($vec->x + 3, 76, $vec->z + 1, 2);
		$level->setBlockIdAt($vec->x + 8, 76, $vec->z + 1, 3);
		$level->setBlockIdAt($vec->x + 9, 76, $vec->z + 1, 3);
		$level->setBlockIdAt($vec->x + 10, 76, $vec->z + 1, 3);
		$level->setBlockIdAt($vec->x + 11, 76, $vec->z + 1, 3);
		$level->setBlockIdAt($vec->x + 12, 76, $vec->z + 1, 3);
		$level->setBlockIdAt($vec->x + 13, 76, $vec->z + 1, 3);
		$level->setBlockIdAt($vec->x + 14, 76, $vec->z + 1, 2);
		
		$level->setBlockIdAt($vec->x + 7, 76, $vec->z + 0, 2);
		$level->setBlockIdAt($vec->x + 6, 76, $vec->z + 0, 2);
		$level->setBlockIdAt($vec->x + 5, 76, $vec->z + 0, 2);
		$level->setBlockIdAt($vec->x + 4, 76, $vec->z + 0, 2);
		$level->setBlockIdAt($vec->x + 8, 76, $vec->z + 0, 3);	
		$level->setBlockIdAt($vec->x + 9, 76, $vec->z + 0, 3);
		$level->setBlockIdAt($vec->x + 10, 76, $vec->z + 0, 3);
		$level->setBlockIdAt($vec->x + 11, 76, $vec->z + 0, 3);
		$level->setBlockIdAt($vec->x + 12, 76, $vec->z + 0, 3);
		$level->setBlockIdAt($vec->x + 13, 76, $vec->z + 0, 2);
		
		$level->setBlockIdAt($vec->x + 7, 76, $vec->z - 1, 2);
		$level->setBlockIdAt($vec->x + 8, 76, $vec->z - 1, 3);
		$level->setBlockIdAt($vec->x + 9, 76, $vec->z - 1, 3);
		$level->setBlockIdAt($vec->x + 10, 76, $vec->z - 1, 3);
		$level->setBlockIdAt($vec->x + 11, 76, $vec->z - 1, 3);
		$level->setBlockIdAt($vec->x + 12, 76, $vec->z - 1, 3);
		###
		
		# Tầng 15
		$level->setBlockIdAt($vec->x + 7, 77, $vec->z + 7, 4); #day là id 4
		$level->setBlockIdAt($vec->x + 6, 77, $vec->z + 7, 4);
		$level->setBlockIdAt($vec->x + 5, 77, $vec->z + 7, 4);
		$level->setBlockIdAt($vec->x + 4, 77, $vec->z + 7, 3);
		$level->setBlockIdAt($vec->x + 3, 77, $vec->z + 7, 2);
		$level->setBlockIdAt($vec->x + 8, 77, $vec->z + 7, 4);
		$level->setBlockIdAt($vec->x + 9, 77, $vec->z + 7, 4);
		$level->setBlockIdAt($vec->x + 10, 77, $vec->z + 7, 4);
		$level->setBlockIdAt($vec->x + 11, 77, $vec->z + 7, 4);
		$level->setBlockIdAt($vec->x + 12, 77, $vec->z + 7, 3);
		$level->setBlockIdAt($vec->x + 13, 77, $vec->z + 7, 13);
		$level->setBlockIdAt($vec->x + 14, 77, $vec->z + 7, 2);
		$level->setBlockIdAt($vec->x + 15, 77, $vec->z + 7, 2);
		$level->setBlockIdAt($vec->x + 16, 77, $vec->z + 7, 2);
		
		$level->setBlockIdAt($vec->x + 7, 77, $vec->z + 8, 3);
		$level->setBlockIdAt($vec->x + 6, 77, $vec->z + 8, 2);
		$level->setBlockIdAt($vec->x + 5, 77, $vec->z + 8, 3);
		$level->setBlockIdAt($vec->x + 4, 77, $vec->z + 8, 3);
		$level->setBlockIdAt($vec->x + 3, 77, $vec->z + 8, 3);
		$level->setBlockIdAt($vec->x + 2, 77, $vec->z + 8, 2);
		$level->setBlockIdAt($vec->x + 8, 77, $vec->z + 8, 3);
		$level->setBlockIdAt($vec->x + 9, 77, $vec->z + 8, 3);
		$level->setBlockIdAt($vec->x + 10, 77, $vec->z + 8, 2);
		$level->setBlockIdAt($vec->x + 11, 77, $vec->z + 8, 3);
		$level->setBlockIdAt($vec->x + 12, 77, $vec->z + 8, 3);
		$level->setBlockIdAt($vec->x + 13, 77, $vec->z + 8, 13);
		$level->setBlockIdAt($vec->x + 14, 77, $vec->z + 8, 2);
		$level->setBlockIdAt($vec->x + 15, 77, $vec->z + 8, 2);
		$level->setBlockIdAt($vec->x + 16, 77, $vec->z + 8, 2);
		$level->setBlockIdAt($vec->x + 17, 77, $vec->z + 8, 2);
		
		$level->setBlockIdAt($vec->x + 7, 77, $vec->z + 9, 2);
		$level->setBlockIdAt($vec->x + 6, 77, $vec->z + 9, 12);
		$level->setBlockIdAt($vec->x + 5, 77, $vec->z + 9, 12);
		$level->setBlockIdAt($vec->x + 4, 77, $vec->z + 9, 3);
		$level->setBlockIdAt($vec->x + 3, 77, $vec->z + 9, 2);
		$level->setBlockIdAt($vec->x + 2, 77, $vec->z + 9, 2);
		$level->setBlockIdAt($vec->x + 8, 77, $vec->z + 9, 3);
		$level->setBlockIdAt($vec->x + 9, 77, $vec->z + 9, 2);
		$level->setBlockIdAt($vec->x + 10, 77, $vec->z + 9, 2);
		$level->setBlockIdAt($vec->x + 11, 77, $vec->z + 9, 2);
		$level->setBlockIdAt($vec->x + 12, 77, $vec->z + 9, 3);
		$level->setBlockIdAt($vec->x + 13, 77, $vec->z + 9, 2);
		$level->setBlockIdAt($vec->x + 14, 77, $vec->z + 9, 2);
		$level->setBlockIdAt($vec->x + 15, 77, $vec->z + 9, 13);
		$level->setBlockIdAt($vec->x + 16, 77, $vec->z + 9, 2);
		
		$level->setBlockIdAt($vec->x + 8, 77, $vec->z + 10, 2);
		$level->setBlockIdAt($vec->x + 5, 77, $vec->z + 10, 12);
		$level->setBlockIdAt($vec->x + 4, 77, $vec->z + 10, 2);
		$level->setBlockIdAt($vec->x + 3, 77, $vec->z + 10, 2);
		$level->setBlockIdAt($vec->x + 11, 77, $vec->z + 10, 2);
		$level->setBlockIdAt($vec->x + 10, 77, $vec->z + 10, 2);
		$level->setBlockIdAt($vec->x + 9, 77, $vec->z + 10, 2);
		$level->setBlockIdAt($vec->x + 12, 77, $vec->z + 10, 2);
		$level->setBlockIdAt($vec->x + 13, 77, $vec->z + 10, 13);
		$level->setBlockIdAt($vec->x + 14, 77, $vec->z + 10, 2);
		$level->setBlockIdAt($vec->x + 15, 77, $vec->z + 10, 2);
		
		$level->setBlockIdAt($vec->x + 9, 77, $vec->z + 11, 2);
		$level->setBlockIdAt($vec->x + 10, 77, $vec->z + 11, 2);
		$level->setBlockIdAt($vec->x + 11, 77, $vec->z + 11, 13);
		$level->setBlockIdAt($vec->x + 12, 77, $vec->z + 11, 2);
		$level->setBlockIdAt($vec->x + 13, 77, $vec->z + 11, 13);
				
		$level->setBlockIdAt($vec->x + 9, 77, $vec->z + 12, 2);
		$level->setBlockIdAt($vec->x + 10, 77, $vec->z + 12, 2);
		$level->setBlockIdAt($vec->x + 11, 77, $vec->z + 12, 13);

		$level->setBlockIdAt($vec->x + 9, 77, $vec->z + 13, 85); 
		$level->setBlockIdAt($vec->x + 10, 77, $vec->z + 13, 17);
		$level->setBlockDataAt($vec->x + 10, 77, $vec->z + 13, 15);
		
		$level->setBlockIdAt($vec->x + 9, 77, $vec->z + 14, 17);
		$level->setBlockDataAt($vec->x + 9, 77, $vec->z + 14, 15);
		
		$level->setBlockIdAt($vec->x + 10, 77, $vec->z + 14, 85);
		
		$level->setBlockIdAt($vec->x + 9, 77, $vec->z + 15, 85);
		
		$level->setBlockIdAt($vec->x + 7, 77, $vec->z + 6, 4);
		$level->setBlockIdAt($vec->x + 6, 77, $vec->z + 6, 4);
		$level->setBlockIdAt($vec->x + 5, 77, $vec->z + 6, 4);
		$level->setBlockIdAt($vec->x + 4, 77, $vec->z + 6, 2);
		$level->setBlockIdAt($vec->x + 3, 77, $vec->z + 6, 2);
		$level->setBlockIdAt($vec->x + 8, 77, $vec->z + 6, 4);
		$level->setBlockIdAt($vec->x + 9, 77, $vec->z + 6, 4);
		$level->setBlockIdAt($vec->x + 10, 77, $vec->z + 6, 4);
		$level->setBlockIdAt($vec->x + 11, 77, $vec->z + 6, 4);
		$level->setBlockIdAt($vec->x + 12, 77, $vec->z + 6, 13);
		$level->setBlockIdAt($vec->x + 13, 77, $vec->z + 6, 2);
		$level->setBlockIdAt($vec->x + 14, 77, $vec->z + 6, 13);
		$level->setBlockIdAt($vec->x + 15, 77, $vec->z + 6, 2);
		
		$level->setBlockIdAt($vec->x + 7, 77, $vec->z + 5, 4);
		$level->setBlockIdAt($vec->x + 6, 77, $vec->z + 5, 4);
		$level->setBlockIdAt($vec->x + 5, 77, $vec->z + 5, 4);
		$level->setBlockIdAt($vec->x + 4, 77, $vec->z + 5, 3);
		$level->setBlockIdAt($vec->x + 3, 77, $vec->z + 5, 2);
		$level->setBlockIdAt($vec->x + 2, 77, $vec->z + 5, 2);
		$level->setBlockIdAt($vec->x + 8, 77, $vec->z + 5, 4);
		$level->setBlockIdAt($vec->x + 9, 77, $vec->z + 5, 4);
		$level->setBlockIdAt($vec->x + 10, 77, $vec->z + 5, 4);
		$level->setBlockIdAt($vec->x + 11, 77, $vec->z + 5, 4);
		$level->setBlockIdAt($vec->x + 12, 77, $vec->z + 5, 3);
		$level->setBlockIdAt($vec->x + 13, 77, $vec->z + 5, 2);
		$level->setBlockIdAt($vec->x + 14, 77, $vec->z + 5, 2);
		$level->setBlockIdAt($vec->x + 15, 77, $vec->z + 5, 2);//////////////
		
		$level->setBlockIdAt($vec->x + 7, 77, $vec->z + 4, 3);
		$level->setBlockIdAt($vec->x + 6, 77, $vec->z + 4, 2);
		$level->setBlockIdAt($vec->x + 5, 77, $vec->z + 4, 3);
		$level->setBlockIdAt($vec->x + 4, 77, $vec->z + 4, 3);
		$level->setBlockIdAt($vec->x + 3, 77, $vec->z + 4, 3);
		$level->setBlockIdAt($vec->x + 2, 77, $vec->z + 4, 2);
		$level->setBlockIdAt($vec->x + 8, 77, $vec->z + 4, 3);
		$level->setBlockIdAt($vec->x + 9, 77, $vec->z + 4, 3);
		$level->setBlockIdAt($vec->x + 11, 77, $vec->z + 4, 3);
		$level->setBlockIdAt($vec->x + 10, 77, $vec->z + 4, 4);
		$level->setBlockIdAt($vec->x + 12, 77, $vec->z + 4, 3);
		$level->setBlockIdAt($vec->x + 13, 77, $vec->z + 4, 3);
		$level->setBlockIdAt($vec->x + 14, 77, $vec->z + 4, 2);
		
		$level->setBlockIdAt($vec->x + 7, 77, $vec->z + 3, 2);
		$level->setBlockIdAt($vec->x + 6, 77, $vec->z + 3, 2);
		$level->setBlockIdAt($vec->x + 5, 77, $vec->z + 3, 2);
		$level->setBlockIdAt($vec->x + 4, 77, $vec->z + 3, 3);
		$level->setBlockIdAt($vec->x + 3, 77, $vec->z + 3, 2);
		$level->setBlockIdAt($vec->x + 8, 77, $vec->z + 3, 3);
		$level->setBlockIdAt($vec->x + 9, 77, $vec->z + 3, 2);
		$level->setBlockIdAt($vec->x + 10, 77, $vec->z + 3, 2);
		$level->setBlockIdAt($vec->x + 11, 77, $vec->z + 3, 2);
		$level->setBlockIdAt($vec->x + 12, 77, $vec->z + 3, 3);
		$level->setBlockIdAt($vec->x + 13, 77, $vec->z + 3, 2);
		$level->setBlockIdAt($vec->x + 14, 77, $vec->z + 3, 2);
		
		$level->setBlockIdAt($vec->x + 7, 77, $vec->z + 2, 2);
		$level->setBlockIdAt($vec->x + 6, 77, $vec->z + 2, 2);
		$level->setBlockIdAt($vec->x + 5, 77, $vec->z + 2, 2);
		$level->setBlockIdAt($vec->x + 4, 77, $vec->z + 2, 2);
		$level->setBlockIdAt($vec->x + 8, 77, $vec->z + 2, 2);
		$level->setBlockIdAt($vec->x + 9, 77, $vec->z + 2, 60);
		$level->setBlockIdAt($vec->x + 10, 77, $vec->z + 2, 60);
		$level->setBlockIdAt($vec->x + 11, 77, $vec->z + 2, 60);
		$level->setBlockIdAt($vec->x + 12, 77, $vec->z + 2, 2);
		$level->setBlockIdAt($vec->x + 13, 77, $vec->z + 2, 2);
		
		#====IdItem+Damage====
		$level->setBlockIdAt($vec->x + 5, 77, $vec->z + 1, 38);
		$level->setBlockDataAt($vec->x + 5, 77, $vec->z + 1, 7);
		#===================
		$level->setBlockIdAt($vec->x + 7, 77, $vec->z + 1, 2);
		$level->setBlockIdAt($vec->x + 8, 77, $vec->z + 1, 60);
		$level->setBlockIdAt($vec->x + 9, 77, $vec->z + 1, 2);
		$level->setBlockIdAt($vec->x + 10, 77, $vec->z + 1, 9);
		$level->setBlockIdAt($vec->x + 11, 77, $vec->z + 1, 60);
		$level->setBlockIdAt($vec->x + 12, 77, $vec->z + 1, 2);
		
		$level->setBlockIdAt($vec->x + 8, 77, $vec->z + 0, 2);	
		$level->setBlockIdAt($vec->x + 9, 77, $vec->z + 0, 60);
		$level->setBlockIdAt($vec->x + 10, 77, $vec->z + 0, 60);
		$level->setBlockIdAt($vec->x + 11, 77, $vec->z + 0, 60);
		$level->setBlockIdAt($vec->x + 12, 77, $vec->z + 0, 60);
		
		$level->setBlockIdAt($vec->x + 12, 77, $vec->z - 1, 2);
		$level->setBlockIdAt($vec->x + 11, 77, $vec->z - 1, 2);
		$level->setBlockIdAt($vec->x + 10, 77, $vec->z - 1, 2);
		$level->setBlockIdAt($vec->x + 9, 77, $vec->z - 1, 2);
		$level->setBlockIdAt($vec->x + 8, 77, $vec->z - 1, 2);
	
		###
		
		
		# Lớp 16
		$level->setBlockIdAt($vec->x + 9, 78, $vec->z + 15, 17);
        $level->setBlockDataAt($vec->x + 9, 78, $vec->z + 15, 15);
		
		$level->setBlockIdAt($vec->x + 9, 78, $vec->z + 14, 17);
		$level->setBlockDataAt($vec->x + 9, 78, $vec->z + 14, 15);
		
		$level->setBlockIdAt($vec->x + 9, 78, $vec->z + 13, 85);
		
		$level->setBlockIdAt($vec->x + 10, 78, $vec->z + 11, 38);
		$level->setBlockDataAt($vec->x + 10, 78, $vec->z + 11, 4);
		
		$level->setBlockIdAt($vec->x + 12, 78, $vec->z + 9, 98);
		$level->setBlockIdAt($vec->x + 8, 78, $vec->z + 9, 98);
		$level->setBlockIdAt($vec->x + 4, 78, $vec->z + 9, 98);
		
		$level->setBlockIdAt($vec->x + 13, 78, $vec->z + 8, 98);
		$level->setBlockIdAt($vec->x + 12, 78, $vec->z + 8, 17);
		$level->setBlockIdAt($vec->x + 11, 78, $vec->z + 8, 98);
		$level->setBlockIdAt($vec->x + 10, 78, $vec->z + 8, 98);
		$level->setBlockIdAt($vec->x + 9, 78, $vec->z + 8, 98);
		$level->setBlockIdAt($vec->x + 8, 78, $vec->z + 8, 17);
		$level->setBlockIdAt($vec->x + 7, 78, $vec->z + 8, 98);
		$level->setBlockIdAt($vec->x + 6, 78, $vec->z + 8, 98);
		$level->setBlockIdAt($vec->x + 5, 78, $vec->z + 8, 98);
		$level->setBlockIdAt($vec->x + 4, 78, $vec->z + 8, 17);
		$level->setBlockIdAt($vec->x + 3, 78, $vec->z + 8, 98);
		
		$level->setBlockIdAt($vec->x + 12, 78, $vec->z + 7, 98);
		$level->setBlockIdAt($vec->x + 4, 78, $vec->z + 7, 98);
		
		$level->setBlockIdAt($vec->x + 12, 78, $vec->z + 6, 64);
		$level->setBlockIdAt($vec->x + 8, 78, $vec->z + 6, 17);
		
		$level->setBlockIdAt($vec->x + 4, 78, $vec->z + 6, 109);
		$level->setBlockDataAt($vec->x + 4, 78, $vec->z + 6, 4);
		
		$level->setBlockIdAt($vec->x + 12, 78, $vec->z + 5, 98);
		
		$level->setBlockIdAt($vec->x + 4, 78, $vec->z + 5, 98);
		#===IdItem+Damage===
		$level->setBlockIdAt($vec->x + 14, 78, $vec->z + 4, 38);
		$level->setBlockDataAt($vec->x + 14, 78, $vec->z + 4, 6);
		#===================
		$level->setBlockIdAt($vec->x + 13, 78, $vec->z + 4, 98);
		$level->setBlockIdAt($vec->x + 12, 78, $vec->z + 4, 17);
		$level->setBlockIdAt($vec->x + 11, 78, $vec->z + 4, 98);
		$level->setBlockIdAt($vec->x + 10, 78, $vec->z + 4, 107);
		$level->setBlockIdAt($vec->x + 9, 78, $vec->z + 4, 98);
		$level->setBlockIdAt($vec->x + 8, 78, $vec->z + 4, 17);
		$level->setBlockIdAt($vec->x + 7, 78, $vec->z + 4, 98);
		$level->setBlockIdAt($vec->x + 6, 78, $vec->z + 4, 98);
		$level->setBlockIdAt($vec->x + 5, 78, $vec->z + 4, 98);
		$level->setBlockIdAt($vec->x + 4, 78, $vec->z + 4, 17);
		$level->setBlockIdAt($vec->x + 3, 78, $vec->z + 4, 98);
		
		$level->setBlockIdAt($vec->x + 12, 78, $vec->z + 3, 98);
		$level->setBlockIdAt($vec->x + 8, 78, $vec->z + 3, 98);
		#====IdItem+Damage====
		$level->setBlockIdAt($vec->x + 7, 78, $vec->z + 3, 38);
		$level->setBlockDataAt($vec->x + 7, 78, $vec->z + 3, 3);
		#===================
		$level->setBlockIdAt($vec->x + 4, 78, $vec->z + 3, 98);
		
		$level->setBlockIdAt($vec->x + 12, 78, $vec->z + 2, 85);
		#====IdItem+Damage====
		$level->setBlockIdAt($vec->x + 11, 78, $vec->z + 2, 59);
		$level->setBlockDataAt($vec->x + 11, 78, $vec->z + 2, 7);
		#===================
		$level->setBlockIdAt($vec->x + 10, 78, $vec->z + 2, Block::POTATO_BLOCK);
		$level->setBlockIdAt($vec->x + 9, 78, $vec->z + 2, Block::CARROT_BLOCK);
		
		$level->setBlockIdAt($vec->x + 12, 78, $vec->z + 1, 85);
		$level->setBlockIdAt($vec->x + 11, 78, $vec->z + 1, Block::POTATO_BLOCK);
		$level->setBlockIdAt($vec->x + 8, 78, $vec->z + 1, Block::WHEAT_BLOCK);
		
		$level->setBlockIdAt($vec->x + 12, 78, $vec->z + 0, Block::CARROT_BLOCK);
		$level->setBlockIdAt($vec->x + 11, 78, $vec->z + 0, Block::CARROT_BLOCK);
		$level->setBlockIdAt($vec->x + 10, 78, $vec->z + 0, Block::WHEAT_BLOCK);
		$level->setBlockIdAt($vec->x + 9, 78, $vec->z + 0, Block::POTATO_BLOCK);
		
		$level->setBlockIdAt($vec->x + 10, 78, $vec->z - 1, 85);
		$level->setBlockIdAt($vec->x + 9, 78, $vec->z - 1, 85);
		$level->setBlockIdAt($vec->x + 8, 78, $vec->z - 1, 85);
		
		# tầng 17
		
		$level->setBlockIdAt($vec->x + 9, 79, $vec->z + 15, 17);
		$level->setBlockDataAt($vec->x + 9, 79, $vec->z + 15, 15);
		
        $level->setBlockIdAt($vec->x + 12, 79, $vec->z + 7, 109);
        $level->setBlockDataAt($vec->x + 12, 79, $vec->z + 7, 1);
		
		$level->setBlockIdAt($vec->x + 4, 79, $vec->z + 7, 109);
		
		$level->setBlockIdAt($vec->x + 7, 79, $vec->z + 8, 109);
		$level->setBlockDataAt($vec->x + 7, 79, $vec->z + 8, 3);
		
		$level->setBlockIdAt($vec->x + 8, 79, $vec->z + 8, 17);
		
		$level->setBlockIdAt($vec->x + 9, 79, $vec->z + 8, 109);
		$level->setBlockDataAt($vec->x + 9, 79, $vec->z + 8, 3);
		
		$level->setBlockIdAt($vec->x + 10, 79, $vec->z + 8, 139);
		
		$level->setBlockIdAt($vec->x + 11, 79, $vec->z + 8, 109);
		$level->setBlockDataAt($vec->x + 11, 79, $vec->z + 8, 3);
		
		$level->setBlockIdAt($vec->x + 12, 79, $vec->z + 8, 17);
		
		$level->setBlockIdAt($vec->x + 13, 79, $vec->z + 8, 109);
		$level->setBlockDataAt($vec->x + 13, 79, $vec->z + 8, 1);
		
		$level->setBlockIdAt($vec->x + 5, 79, $vec->z + 8, 109);
		$level->setBlockDataAt($vec->x + 5, 79, $vec->z + 8, 3);
		
		$level->setBlockIdAt($vec->x + 4, 79, $vec->z + 8, 17);
		$level->setBlockIdAt($vec->x + 3, 79, $vec->z + 8, 109);
		
		$level->setBlockIdAt($vec->x + 8, 79, $vec->z + 9, 139);
		$level->setBlockIdAt($vec->x + 12, 79, $vec->z + 9, 139);
		$level->setBlockIdAt($vec->x + 4, 79, $vec->z + 9, 139);
		
		$level->setBlockIdAt($vec->x + 8, 79, $vec->z + 6, 17);
		
		$level->setBlockIdAt($vec->x + 12, 79, $vec->z + 6, 64);
		$level->setBlockDataAt($vec->x + 12, 79, $vec->z + 6, 8);
		
		$level->setBlockIdAt($vec->x + 12, 79, $vec->z + 5, 109);
		$level->setBlockDataAt($vec->x + 12, 79, $vec->z + 5, 1);
		
		$level->setBlockIdAt($vec->x + 4, 79, $vec->z + 5, 109);
		
		$level->setBlockIdAt($vec->x + 7, 79, $vec->z + 4, 109);
		$level->setBlockDataAt($vec->x + 7, 79, $vec->z + 4, 2);
		
		$level->setBlockIdAt($vec->x + 8, 79, $vec->z + 4, 17);
		
		$level->setBlockIdAt($vec->x + 9, 79, $vec->z + 4, 109);
		$level->setBlockDataAt($vec->x + 9, 79, $vec->z + 4, 2);
		
		$level->setBlockIdAt($vec->x + 11, 79, $vec->z + 4, 109);
		$level->setBlockDataAt($vec->x + 11, 79, $vec->z + 4, 2);
		
		$level->setBlockIdAt($vec->x + 12, 79, $vec->z + 4, 17);
		
		$level->setBlockIdAt($vec->x + 13, 79, $vec->z + 4, 109);
		$level->setBlockDataAt($vec->x + 13, 79, $vec->z + 4, 1);
		
		$level->setBlockIdAt($vec->x + 5, 79, $vec->z + 4, 109);
		$level->setBlockDataAt($vec->x + 5, 79, $vec->z + 4, 2);
		
		$level->setBlockIdAt($vec->x + 4, 79, $vec->z + 4, 17);
		$level->setBlockIdAt($vec->x + 3, 79, $vec->z + 4, 109);
		
		$level->setBlockIdAt($vec->x + 8, 79, $vec->z + 3, 139);	
		$level->setBlockIdAt($vec->x + 12, 79, $vec->z + 3, 139);
		$level->setBlockIdAt($vec->x + 4, 79, $vec->z + 3, 139);
		###
		
		# tầng 18
        $level->setBlockIdAt($vec->x + 8, 80, $vec->z + 7, 109);
        $level->setBlockDataAt($vec->x + 8, 80, $vec->z + 7, 5);
		
        $level->setBlockIdAt($vec->x + 12, 80, $vec->z + 7, 109);
        $level->setBlockDataAt($vec->x + 12, 80, $vec->z + 7, 5);
		
		$level->setBlockIdAt($vec->x + 4, 80, $vec->z + 7, 109);
		$level->setBlockDataAt($vec->x + 4, 80, $vec->z + 7, 4);
		
		$level->setBlockIdAt($vec->x + 7, 80, $vec->z + 8, 109);
		$level->setBlockDataAt($vec->x + 7, 80, $vec->z + 8, 7);
		
		$level->setBlockIdAt($vec->x + 8, 80, $vec->z + 8, 17);
		
		$level->setBlockIdAt($vec->x + 9, 80, $vec->z + 8, 109);
		$level->setBlockDataAt($vec->x + 9, 80, $vec->z + 8, 7);
		
		$level->setBlockIdAt($vec->x + 10, 80, $vec->z + 8, 5);
		
		$level->setBlockIdAt($vec->x + 11, 80, $vec->z + 8, 109);
		$level->setBlockDataAt($vec->x + 11, 80, $vec->z + 8, 7);
		
		$level->setBlockIdAt($vec->x + 13, 80, $vec->z + 8, 50);
		$level->setBlockDataAt($vec->x + 13, 80, $vec->z + 8, 1);
		
		$level->setBlockIdAt($vec->x + 12, 80, $vec->z + 8, 17);
		$level->setBlockIdAt($vec->x + 6, 80, $vec->z + 8, 5);
		
		$level->setBlockIdAt($vec->x + 5, 80, $vec->z + 8, 109);
		$level->setBlockDataAt($vec->x + 5, 80, $vec->z + 8, 7);
		
		$level->setBlockIdAt($vec->x + 4, 80, $vec->z + 8, 17);
		
		$level->setBlockIdAt($vec->x + 8, 80, $vec->z + 15, 85);
		
		$level->setBlockIdAt($vec->x + 9, 80, $vec->z + 15, 17);
		$level->setBlockDataAt($vec->x + 9, 80, $vec->z + 15, 15);
		
		$level->setBlockIdAt($vec->x + 10, 80, $vec->z + 15, 17);
		$level->setBlockDataAt($vec->x + 10, 80, $vec->z + 15, 15);
		
		$level->setBlockIdAt($vec->x + 8, 80, $vec->z + 16, 17);
		$level->setBlockDataAt($vec->x + 8, 80, $vec->z + 16, 15);
		
		$level->setBlockIdAt($vec->x + 8, 80, $vec->z + 6, 17);
		$level->setBlockIdAt($vec->x + 12, 80, $vec->z + 6, 5);
		$level->setBlockIdAt($vec->x + 4, 80, $vec->z + 6, 5);
		
		$level->setBlockIdAt($vec->x + 8, 80, $vec->z + 5, 109);
		$level->setBlockDataAt($vec->x + 8, 80, $vec->z + 5, 5);
		
		$level->setBlockIdAt($vec->x + 12, 80, $vec->z + 5, 109);
		$level->setBlockDataAt($vec->x + 12, 80, $vec->z + 5, 5);
		
		$level->setBlockIdAt($vec->x + 4, 80, $vec->z + 5, 109);
		$level->setBlockDataAt($vec->x + 4, 80, $vec->z + 5, 4);
		
		$level->setBlockIdAt($vec->x + 7, 80, $vec->z + 4, 109);
		$level->setBlockDataAt($vec->x + 7, 80, $vec->z + 4, 6);
		
		$level->setBlockIdAt($vec->x + 6, 80, $vec->z + 4, 5);
		$level->setBlockIdAt($vec->x + 8, 80, $vec->z + 4, 17);
		
		$level->setBlockIdAt($vec->x + 9, 80, $vec->z + 4, 109);
		$level->setBlockDataAt($vec->x + 9, 80, $vec->z + 4, 6);
		
		$level->setBlockIdAt($vec->x + 10, 80, $vec->z + 4, 5);
		
		$level->setBlockIdAt($vec->x + 11, 80, $vec->z + 4, 109);
		$level->setBlockDataAt($vec->x + 11, 80, $vec->z + 4, 6);
		
		$level->setBlockIdAt($vec->x + 12, 80, $vec->z + 4, 17);
		
		$level->setBlockIdAt($vec->x + 13, 80, $vec->z + 4, 50);
		$level->setBlockDataAt($vec->x + 13, 80, $vec->z + 4, 1);
		
		$level->setBlockIdAt($vec->x + 5, 80, $vec->z + 4, 109);
		$level->setBlockDataAt($vec->x + 5, 80, $vec->z + 4, 6);
		
		$level->setBlockIdAt($vec->x + 4, 80, $vec->z + 4, 17);
		###
		
		#Tầng 19
		$level->setBlockIdAt($vec->x + 10, 81, $vec->z + 17, 35);
		$level->setBlockDataAt($vec->x + 10, 81, $vec->z + 17, 14);
		
		$level->setBlockIdAt($vec->x + 8, 81, $vec->z + 17, 35);
		$level->setBlockDataAt($vec->x + 8, 81, $vec->z + 17, 6);
		
		$level->setBlockIdAt($vec->x + 10, 81, $vec->z + 16, 35);
		$level->setBlockDataAt($vec->x + 10, 81, $vec->z + 16, 14);
		
		$level->setBlockIdAt($vec->x + 8, 81, $vec->z + 16, 17);
		$level->setBlockDataAt($vec->x + 8, 81, $vec->z + 16, 15);
		
		$level->setBlockIdAt($vec->x + 10, 81, $vec->z + 15, 17);
		$level->setBlockDataAt($vec->x + 10, 81, $vec->z + 15, 15);
		
		$level->setBlockIdAt($vec->x + 9, 81, $vec->z + 15, 35);
		
		$level->setBlockIdAt($vec->x + 7, 81, $vec->z + 15, 17);
		$level->setBlockDataAt($vec->x + 7, 81, $vec->z + 15, 15);
		
		$level->setBlockIdAt($vec->x + 11, 81, $vec->z + 14, 17);
		$level->setBlockDataAt($vec->x + 11, 81, $vec->z + 14, 15);
		
		$level->setBlockIdAt($vec->x + 3, 81, $vec->z + 14, 35);
		$level->setBlockDataAt($vec->x + 3, 81, $vec->z + 14, 14);
		
		$level->setBlockIdAt($vec->x + 13, 81, $vec->z + 9, 109);#109:3
		$level->setBlockDataAt($vec->x + 13, 81, $vec->z + 9, 3);
		
		$level->setBlockIdAt($vec->x + 12, 81, $vec->z + 9, 109);#109:3
		$level->setBlockDataAt($vec->x + 12, 81, $vec->z + 9, 3);
		
		$level->setBlockIdAt($vec->x + 11, 81, $vec->z + 9, 109);#109:3
		$level->setBlockDataAt($vec->x + 11, 81, $vec->z + 9, 3);
		
		$level->setBlockIdAt($vec->x + 10, 81, $vec->z + 9, 109);#109:3
		$level->setBlockDataAt($vec->x + 10, 81, $vec->z + 9, 3);
		
		$level->setBlockIdAt($vec->x + 9, 81, $vec->z + 9, 109);#109:3
		$level->setBlockDataAt($vec->x + 9, 81, $vec->z + 9, 3);
		
		$level->setBlockIdAt($vec->x + 8, 81, $vec->z + 9, 109);#109:3
		$level->setBlockDataAt($vec->x + 8, 81, $vec->z + 9, 3);
		
		$level->setBlockIdAt($vec->x + 7, 81, $vec->z + 9, 109);#109:3
		$level->setBlockDataAt($vec->x + 7, 81, $vec->z + 9, 3);
		
		$level->setBlockIdAt($vec->x + 6, 81, $vec->z + 9, 109);#109:3
		$level->setBlockDataAt($vec->x + 6, 81, $vec->z + 9, 3);
		
		$level->setBlockIdAt($vec->x + 5, 81, $vec->z + 9, 109);#109:3
		$level->setBlockDataAt($vec->x + 5, 81, $vec->z + 9, 3);
		
		$level->setBlockIdAt($vec->x + 4, 81, $vec->z + 9, 109);#109:3
		$level->setBlockDataAt($vec->x + 4, 81, $vec->z + 9, 3);
		
		$level->setBlockIdAt($vec->x + 3, 81, $vec->z + 9, 109);#109:3
		$level->setBlockDataAt($vec->x + 3, 81, $vec->z + 9, 3);
		
		
		$level->setBlockIdAt($vec->x + 13, 81, $vec->z + 8, 109);#109:6
		$level->setBlockDataAt($vec->x + 13, 81, $vec->z + 8, 6);
		
		$level->setBlockIdAt($vec->x + 12, 81, $vec->z + 8, 17);
		
		$level->setBlockIdAt($vec->x + 11, 81, $vec->z + 8, 17);#17:4
		$level->setBlockDataAt($vec->x + 11, 81, $vec->z + 8, 4);
		
		$level->setBlockIdAt($vec->x + 10, 81, $vec->z + 8, 17);#17:4
		$level->setBlockDataAt($vec->x + 10, 81, $vec->z + 8, 4);
		
		$level->setBlockIdAt($vec->x + 9, 81, $vec->z + 8, 17);#17:4
		$level->setBlockDataAt($vec->x + 9, 81, $vec->z + 8, 4);
		
		$level->setBlockDataAt($vec->x + 8, 81, $vec->z + 8, 17);
		
		$level->setBlockIdAt($vec->x + 7, 81, $vec->z + 8, 17);#17:4
		$level->setBlockDataAt($vec->x + 7, 81, $vec->z + 8, 4);
		
		$level->setBlockIdAt($vec->x + 6, 81, $vec->z + 8, 17);#17:4
		$level->setBlockDataAt($vec->x + 6, 81, $vec->z + 8, 4);
		
		$level->setBlockIdAt($vec->x + 5, 81, $vec->z + 8, 17);#17:4
		$level->setBlockDataAt($vec->x + 5, 81, $vec->z + 8, 4);
		
		$level->setBlockIdAt($vec->x + 4, 81, $vec->z + 8, 17);
		
		$level->setBlockIdAt($vec->x + 3, 81, $vec->z + 8, 109);#109:6
		$level->setBlockDataAt($vec->x + 3, 81, $vec->z + 8, 6);
		
		
		$level->setBlockIdAt($vec->x + 13, 81, $vec->z + 7, 44);#44:13
		$level->setBlockDataAt($vec->x + 13, 81, $vec->z + 7, 13);
		
		$level->setBlockIdAt($vec->x + 12, 81, $vec->z + 7, 17);#17:4
		$level->setBlockDataAt($vec->x + 12, 81, $vec->z + 7, 4);
		
		$level->setBlockIdAt($vec->x + 11, 81, $vec->z + 7, 5);#5:1
		$level->setBlockDataAt($vec->x + 11, 81, $vec->z + 7, 1);
		
		$level->setBlockIdAt($vec->x + 10, 81, $vec->z + 7, 5);#5:1
		$level->setBlockDataAt($vec->x + 10, 81, $vec->z + 7, 1);
		
		$level->setBlockIdAt($vec->x + 9, 81, $vec->z + 7, 5);#5:1
		$level->setBlockDataAt($vec->x + 9, 81, $vec->z + 7, 1);
		
		$level->setBlockIdAt($vec->x + 8, 81, $vec->z + 7, 5);#5:1
		$level->setBlockDataAt($vec->x + 8, 81, $vec->z + 7, 1);
		
		$level->setBlockIdAt($vec->x + 7, 81, $vec->z + 7, 5);#5:1
		$level->setBlockDataAt($vec->x + 7, 81, $vec->z + 7, 1);
		
		$level->setBlockIdAt($vec->x + 6, 81, $vec->z + 7, 5);#5:1
		$level->setBlockDataAt($vec->x + 6, 81, $vec->z + 7, 1);
		
		$level->setBlockIdAt($vec->x + 5, 81, $vec->z + 7, 5);#5:1
		$level->setBlockDataAt($vec->x + 5, 81, $vec->z + 7, 1);
		
		$level->setBlockIdAt($vec->x + 4, 81, $vec->z + 7, 17);#17:4
		$level->setBlockDataAt($vec->x + 4, 81, $vec->z + 7, 4);
		
		$level->setBlockIdAt($vec->x + 3, 81, $vec->z + 7, 44);#44:13
		$level->setBlockDataAt($vec->x + 3, 81, $vec->z + 7, 13);
		
		
		$level->setBlockIdAt($vec->x + 13, 81, $vec->z + 6, 109);#109:5
		$level->setBlockDataAt($vec->x + 13, 81, $vec->z + 6, 5);
		
		$level->setBlockIdAt($vec->x + 12, 81, $vec->z + 6, 109);#17:4
		$level->setBlockDataAt($vec->x + 12, 81, $vec->z + 6, 5);
		
		$level->setBlockIdAt($vec->x + 11, 81, $vec->z + 6, 5);#5:1
		$level->setBlockDataAt($vec->x + 11, 81, $vec->z + 6, 1);
		
		$level->setBlockIdAt($vec->x + 10, 81, $vec->z + 6, 5);#5:1
		$level->setBlockDataAt($vec->x + 10, 81, $vec->z + 6, 1);
		
		$level->setBlockIdAt($vec->x + 8, 81, $vec->z + 6, 17);#17:4
		$level->setBlockDataAt($vec->x + 8, 81, $vec->z + 6, 4);
		
		$level->setBlockIdAt($vec->x + 7, 81, $vec->z + 6, 5);#5:1
		$level->setBlockDataAt($vec->x + 7, 81, $vec->z + 6, 1);
		
		$level->setBlockIdAt($vec->x + 6, 81, $vec->z + 6, 5);#5:1
		$level->setBlockDataAt($vec->x + 6, 81, $vec->z + 6, 1);
		
		$level->setBlockIdAt($vec->x + 5, 81, $vec->z + 6, 5);#5:1
		$level->setBlockDataAt($vec->x + 5, 81, $vec->z + 6, 1);
		
		$level->setBlockIdAt($vec->x + 4, 81, $vec->z + 6, 17);#17:4
		$level->setBlockDataAt($vec->x + 4, 81, $vec->z + 6, 4);
		
		$level->setBlockIdAt($vec->x + 3, 81, $vec->z + 6, 109);#109:5
		$level->setBlockDataAt($vec->x + 3, 81, $vec->z + 6, 5);
		
		
		$level->setBlockIdAt($vec->x + 13, 81, $vec->z + 5, 44);#44:13
		$level->setBlockDataAt($vec->x + 13, 81, $vec->z + 5, 13);#44:13
		
		$level->setBlockIdAt($vec->x + 12, 81, $vec->z + 5, 17);#17:4
		$level->setBlockDataAt($vec->x + 12, 81, $vec->z + 5, 4);#17:4
		
		$level->setBlockIdAt($vec->x + 11, 81, $vec->z + 5, 5);#5:1
		$level->setBlockDataAt($vec->x + 11, 81, $vec->z + 5, 1);#5:1
		
		$level->setBlockIdAt($vec->x + 10, 81, $vec->z + 5, 5);#5:1
		$level->setBlockDataAt($vec->x + 10, 81, $vec->z + 5, 1);#5:1
		
		$level->setBlockIdAt($vec->x + 9, 81, $vec->z + 5, 5);#5:1
		$level->setBlockDataAt($vec->x + 9, 81, $vec->z + 5, 1);#5:1
		
		$level->setBlockIdAt($vec->x + 8, 81, $vec->z + 5, 5);#5:1
		$level->setBlockDataAt($vec->x + 8, 81, $vec->z + 5, 1);#5:1
		
		$level->setBlockIdAt($vec->x + 7, 81, $vec->z + 5, 5);#5:1
		$level->setBlockDataAt($vec->x + 7, 81, $vec->z + 5, 1);#5:1
		
		$level->setBlockIdAt($vec->x + 6, 81, $vec->z + 5, 5);#5:1
		$level->setBlockDataAt($vec->x + 6, 81, $vec->z + 5, 1);#5:1
		
		$level->setBlockIdAt($vec->x + 5, 81, $vec->z + 5, 5);#5:1
		$level->setBlockDataAt($vec->x + 5, 81, $vec->z + 5, 1);#5:1
		
		$level->setBlockIdAt($vec->x + 4, 81, $vec->z + 5, 17);#17:4
		$level->setBlockDataAt($vec->x + 4, 81, $vec->z + 5, 4);#17:4
		
		$level->setBlockIdAt($vec->x + 3, 81, $vec->z + 5, 44);#44:13
		$level->setBlockDataAt($vec->x + 3, 81, $vec->z + 5, 13);#44:13
		
		
		$level->setBlockIdAt($vec->x + 13, 81, $vec->z + 4, 109);#109:7
		$level->setBlockDataAt($vec->x + 13, 81, $vec->z + 4, 7);
		
		$level->setBlockIdAt($vec->x + 12, 81, $vec->z + 4, 109);#17:4
		$level->setBlockDataAt($vec->x + 12, 81, $vec->z + 6, 5);
		
		$level->setBlockIdAt($vec->x + 11, 81, $vec->z + 4, 5);#5:1
		$level->setBlockDataAt($vec->x + 11, 81, $vec->z + 4, 1);
		
		$level->setBlockIdAt($vec->x + 10, 81, $vec->z + 4, 5);#5:1
		$level->setBlockDataAt($vec->x + 10, 81, $vec->z + 4, 1);
		
		$level->setBlockIdAt($vec->x + 8, 81, $vec->z + 4, 17);#17:4
		$level->setBlockDataAt($vec->x + 8, 81, $vec->z + 4, 4);
		
		$level->setBlockIdAt($vec->x + 7, 81, $vec->z + 4, 5);#5:1
		$level->setBlockDataAt($vec->x + 7, 81, $vec->z + 4, 1);
		
		$level->setBlockIdAt($vec->x + 6, 81, $vec->z + 4, 5);#5:1
		$level->setBlockDataAt($vec->x + 6, 81, $vec->z + 4, 1);
		
		$level->setBlockIdAt($vec->x + 5, 81, $vec->z + 4, 5);#5:1
		$level->setBlockDataAt($vec->x + 5, 81, $vec->z + 4, 1);
		
		$level->setBlockIdAt($vec->x + 4, 81, $vec->z + 4, 17);#17:4
		$level->setBlockDataAt($vec->x + 4, 81, $vec->z + 4, 4);
		
		$level->setBlockIdAt($vec->x + 3, 81, $vec->z + 4, 109);#109:7
		$level->setBlockDataAt($vec->x + 3, 81, $vec->z + 4, 7);
		
		
		$level->setBlockIdAt($vec->x + 13, 81, $vec->z + 3, 109);#109:2
		$level->setBlockDataAt($vec->x + 13, 81, $vec->z + 3, 2);
		
		$level->setBlockIdAt($vec->x + 12, 81, $vec->z + 3, 109);#109:2
		$level->setBlockDataAt($vec->x + 12, 81, $vec->z + 3, 2);
		
		$level->setBlockIdAt($vec->x + 11, 81, $vec->z + 3, 109);#109:2
		$level->setBlockDataAt($vec->x + 11, 81, $vec->z + 3, 2);
		
		$level->setBlockIdAt($vec->x + 10, 81, $vec->z + 3, 109);#109:2
		$level->setBlockDataAt($vec->x + 10, 81, $vec->z + 3, 2);
		
		$level->setBlockIdAt($vec->x + 9, 81, $vec->z + 3, 109);#109:2
		$level->setBlockDataAt($vec->x + 9, 81, $vec->z + 3, 2);
		
		$level->setBlockIdAt($vec->x + 8, 81, $vec->z + 3, 109);#109:2
		$level->setBlockDataAt($vec->x + 8, 81, $vec->z + 3, 2);
		
		$level->setBlockIdAt($vec->x + 7, 81, $vec->z + 3, 109);#109:2
		$level->setBlockDataAt($vec->x + 7, 81, $vec->z + 3, 2);
		
		$level->setBlockIdAt($vec->x + 6, 81, $vec->z + 3, 109);#109:2
		$level->setBlockDataAt($vec->x + 6, 81, $vec->z + 3, 2);
		
		$level->setBlockIdAt($vec->x + 5, 81, $vec->z + 3, 109);#109:2
		$level->setBlockDataAt($vec->x + 5, 81, $vec->z + 3, 2);
		
		$level->setBlockIdAt($vec->x + 4, 81, $vec->z + 3, 109);#109:2
		$level->setBlockDataAt($vec->x + 4, 81, $vec->z + 3, 2);
		
		$level->setBlockIdAt($vec->x + 3, 81, $vec->z + 3, 109);#109:2
		$level->setBlockDataAt($vec->x + 3, 81, $vec->z + 3, 2);
		###
		
		#Lớp 20
		$level->setBlockIdAt($vec->x + 10, 82, $vec->z + 19, 35);#35:6
		$level->setBlockDataAt($vec->x + 10, 82, $vec->z + 19, 6);
		
		$level->setBlockIdAt($vec->x + 11, 82, $vec->z + 17, 35);#35:6
		$level->setBlockDataAt($vec->x + 11, 82, $vec->z + 17, 6);
		
		$level->setBlockIdAt($vec->x + 8, 82, $vec->z + 17, 35);
		$level->setBlockIdAt($vec->x + 7, 82, $vec->z + 17, 35);
		$level->setBlockIdAt($vec->x + 4, 82, $vec->z + 17, 35);
		
		$level->setBlockIdAt($vec->x + 9, 82, $vec->z + 16, 35);#35:14
		$level->setBlockDataAt($vec->x + 9, 82, $vec->z + 16, 14);
		
		$level->setBlockIdAt($vec->x + 8, 82, $vec->z + 16, 35);#35
		
		$level->setBlockIdAt($vec->x + 7, 82, $vec->z + 16, 85);#35
		
		$level->setBlockIdAt($vec->x + 8, 82, $vec->z + 15, 35);#35
		
		$level->setBlockIdAt($vec->x + 7, 82, $vec->z + 15, 17);#17:15
		$level->setBlockDataAt($vec->x + 7, 82, $vec->z + 15, 15);
		
		$level->setBlockIdAt($vec->x + 11, 82, $vec->z + 14, 17);#17:15
		$level->setBlockDataAt($vec->x + 11, 82, $vec->z + 14, 15);
		
		$level->setBlockIdAt($vec->x + 3, 82, $vec->z + 14, 35);#35:14
		$level->setBlockDataAt($vec->x + 3, 82, $vec->z + 14, 14);
		
		$level->setBlockIdAt($vec->x + 12, 82, $vec->z + 13, 17);#17:15
		$level->setBlockDataAt($vec->x + 12, 82, $vec->z + 13, 15);
		
		$level->setBlockIdAt($vec->x + 13, 82, $vec->z + 8, 98);
		$level->setBlockIdAt($vec->x + 12, 82, $vec->z + 8, 5);
		$level->setBlockIdAt($vec->x + 11, 82, $vec->z + 8, 5);
		$level->setBlockIdAt($vec->x + 10, 82, $vec->z + 8, 5);
		$level->setBlockIdAt($vec->x + 9, 82, $vec->z + 8, 5);
		$level->setBlockIdAt($vec->x + 8, 82, $vec->z + 8, 5);
		$level->setBlockIdAt($vec->x + 7, 82, $vec->z + 8, 5);
		$level->setBlockIdAt($vec->x + 6, 82, $vec->z + 8, 5);
		$level->setBlockIdAt($vec->x + 5, 82, $vec->z + 8, 5);
		$level->setBlockIdAt($vec->x + 4, 82, $vec->z + 8, 5);
		$level->setBlockIdAt($vec->x + 3, 82, $vec->z + 8, 98);
		
		$level->setBlockIdAt($vec->x + 12, 82, $vec->z + 7, 17);
		$level->setBlockIdAt($vec->x + 4, 82, $vec->z + 7, 17);
		
		$level->setBlockIdAt($vec->x + 12, 82, $vec->z + 6, 53);#53:5
		$level->setBlockDataAt($vec->x + 12, 82, $vec->z + 6, 5);
		
		$level->setBlockIdAt($vec->x + 8, 82, $vec->z + 6, 17);
		
		$level->setBlockIdAt($vec->x + 4, 82, $vec->z + 6, 53);#53:4
		$level->setBlockDataAt($vec->x + 4, 82, $vec->z + 6, 4);
		
		$level->setBlockIdAt($vec->x + 12, 82, $vec->z + 5, 17);
		$level->setBlockIdAt($vec->x + 4, 82, $vec->z + 5, 17);
		
		$level->setBlockIdAt($vec->x + 13, 82, $vec->z + 4, 98);
		$level->setBlockIdAt($vec->x + 12, 82, $vec->z + 4, 5);
		$level->setBlockIdAt($vec->x + 11, 82, $vec->z + 4, 5);
		$level->setBlockIdAt($vec->x + 10, 82, $vec->z + 4, 5);
		$level->setBlockIdAt($vec->x + 9, 82, $vec->z + 4, 5);
		$level->setBlockIdAt($vec->x + 8, 82, $vec->z + 4, 5);
		$level->setBlockIdAt($vec->x + 7, 82, $vec->z + 4, 5);
		$level->setBlockIdAt($vec->x + 6, 82, $vec->z + 4, 5);
		$level->setBlockIdAt($vec->x + 5, 82, $vec->z + 4, 5);
		$level->setBlockIdAt($vec->x + 4, 82, $vec->z + 4, 5);
		$level->setBlockIdAt($vec->x + 3, 82, $vec->z + 4, 98);
		###
		
		#Lớp 21
		$level->setBlockIdAt($vec->x + 10, 83, $vec->z + 19, 35);#35:14
		$level->setBlockDataAt($vec->x + 10, 83, $vec->z + 19, 14);
		
		$level->setBlockIdAt($vec->x + 7, 83, $vec->z + 18, 35);#35:6
		$level->setBlockDataAt($vec->x + 7, 83, $vec->z + 18, 6);
		
		$level->setBlockIdAt($vec->x + 7, 83, $vec->z + 17, 35);#35:6
		$level->setBlockDataAt($vec->x + 7, 83, $vec->z + 17, 6);
		
		$level->setBlockIdAt($vec->x + 6, 83, $vec->z + 17, 35);#35
		
		$level->setBlockIdAt($vec->x + 4, 83, $vec->z + 17, 35);#35:14
		$level->setBlockDataAt($vec->x + 4, 83, $vec->z + 17, 14);
		
		$level->setBlockIdAt($vec->x + 8, 83, $vec->z + 16, 85);
		
		$level->setBlockIdAt($vec->x + 7, 83, $vec->z + 16, 35);#35:6
		$level->setBlockDataAt($vec->x + 7, 83, $vec->z + 16, 6);
		
		$level->setBlockIdAt($vec->x + 6, 83, $vec->z + 16, 35);#35
		
		
		$level->setBlockIdAt($vec->x + 8, 83, $vec->z + 15, 35);#35
		
		$level->setBlockIdAt($vec->x + 7, 83, $vec->z + 15, 17);#17:15
		$level->setBlockDataAt($vec->x + 7, 83, $vec->z + 15, 15);
		
		$level->setBlockIdAt($vec->x + 6, 83, $vec->z + 15, 35);#35
		
		$level->setBlockIdAt($vec->x + 4, 83, $vec->z + 15, 35);#35:14
		$level->setBlockDataAt($vec->x + 4, 83, $vec->z + 15, 14);
		
		$level->setBlockIdAt($vec->x + 3, 83, $vec->z + 15, 35);#35:6
		$level->setBlockDataAt($vec->x + 3, 83, $vec->z + 15, 6);
		
		
		$level->setBlockIdAt($vec->x + 12, 83, $vec->z + 14, 35);#35
		$level->setBlockIdAt($vec->x + 3, 83, $vec->z + 14, 35);#35
		
		$level->setBlockIdAt($vec->x + 13, 83, $vec->z + 13, 35);#35:14
		$level->setBlockDataAt($vec->x + 13, 83, $vec->z + 13, 14);
		
		$level->setBlockIdAt($vec->x + 12, 83, $vec->z + 13, 17);#17:15
		$level->setBlockDataAt($vec->x + 12, 83, $vec->z + 13, 15);
		
		$level->setBlockIdAt($vec->x + 11, 83, $vec->z + 13, 35);#35
		
		$level->setBlockIdAt($vec->x + 12, 83, $vec->z + 12, 35);#35:14
		$level->setBlockDataAt($vec->x + 12, 83, $vec->z + 12, 14);
		
		$level->setBlockIdAt($vec->x + 12, 83, $vec->z + 11, 35);#35
		
		
		$level->setBlockIdAt($vec->x + 13, 83, $vec->z + 8, 109);#109:3
		$level->setBlockDataAt($vec->x + 13, 83, $vec->z + 8, 3);
		
		$level->setBlockIdAt($vec->x + 12, 83, $vec->z + 8, 53);#53:3
		$level->setBlockDataAt($vec->x + 12, 83, $vec->z + 8, 3);
		
		$level->setBlockIdAt($vec->x + 11, 83, $vec->z + 8, 53);#53:3
		$level->setBlockDataAt($vec->x + 11, 83, $vec->z + 8, 3);
		
		$level->setBlockIdAt($vec->x + 10, 83, $vec->z + 8, 53);#53:3
		$level->setBlockDataAt($vec->x + 10, 83, $vec->z + 8, 3);
		
		$level->setBlockIdAt($vec->x + 9, 83, $vec->z + 8, 53);#53:3
		$level->setBlockDataAt($vec->x + 9, 83, $vec->z + 8, 3);
		
		$level->setBlockIdAt($vec->x + 8, 83, $vec->z + 8, 53);#53:3
		$level->setBlockDataAt($vec->x + 8, 83, $vec->z + 8, 3);
		
		$level->setBlockIdAt($vec->x + 7, 83, $vec->z + 8, 53);#53:3
		$level->setBlockDataAt($vec->x + 7, 83, $vec->z + 8, 3);
		
		$level->setBlockIdAt($vec->x + 6, 83, $vec->z + 8, 53);#53:3
		$level->setBlockDataAt($vec->x + 6, 83, $vec->z + 8, 3);
		
		$level->setBlockIdAt($vec->x + 5, 83, $vec->z + 8, 53);#53:3
		$level->setBlockDataAt($vec->x + 5, 83, $vec->z + 8, 3);
		
		$level->setBlockIdAt($vec->x + 4, 83, $vec->z + 8, 53);#53:3
		$level->setBlockDataAt($vec->x + 4, 83, $vec->z + 8, 3);
		
		$level->setBlockIdAt($vec->x + 3, 83, $vec->z + 8, 109);#109:3
		$level->setBlockDataAt($vec->x + 3, 83, $vec->z + 8, 3);
		
		
		$level->setBlockIdAt($vec->x + 13, 83, $vec->z + 7, 109);#109:6
		$level->setBlockDataAt($vec->x + 13, 83, $vec->z + 7, 6);
		
		$level->setBlockIdAt($vec->x + 12, 83, $vec->z + 7, 17);
		$level->setBlockIdAt($vec->x + 4, 83, $vec->z + 7, 17);
		
		$level->setBlockIdAt($vec->x + 3, 83, $vec->z + 7, 109);#109:6
		$level->setBlockDataAt($vec->x + 3, 83, $vec->z + 7, 6);
		
		$level->setBlockIdAt($vec->x + 12, 83, $vec->z + 6, 102);
		$level->setBlockIdAt($vec->x + 8, 83, $vec->z + 6, 17);
		$level->setBlockIdAt($vec->x + 4, 83, $vec->z + 6, 102);
		
		$level->setBlockIdAt($vec->x + 13, 83, $vec->z + 5, 109);#109:6
		$level->setBlockDataAt($vec->x + 13, 83, $vec->z + 5, 7);
		
		$level->setBlockIdAt($vec->x + 12, 83, $vec->z + 5, 17);
		$level->setBlockIdAt($vec->x + 4, 83, $vec->z + 5, 17);
		
		$level->setBlockIdAt($vec->x + 3, 83, $vec->z + 5, 109);#109:6
		$level->setBlockDataAt($vec->x + 3, 83, $vec->z + 5, 7);
		
		
		$level->setBlockIdAt($vec->x + 13, 83, $vec->z + 4, 109);#109:2
		$level->setBlockDataAt($vec->x + 13, 83, $vec->z + 4, 2);
		
		$level->setBlockIdAt($vec->x + 12, 83, $vec->z + 4, 53);#53:2
		$level->setBlockDataAt($vec->x + 12, 83, $vec->z + 4, 2);
		
		$level->setBlockIdAt($vec->x + 11, 83, $vec->z + 4, 53);#53:2
		$level->setBlockDataAt($vec->x + 11, 83, $vec->z + 4, 2);
		
		$level->setBlockIdAt($vec->x + 10, 83, $vec->z + 4, 53);#53:2
		$level->setBlockDataAt($vec->x + 10, 83, $vec->z + 4, 2);
		
		$level->setBlockIdAt($vec->x + 9, 83, $vec->z + 4, 53);#53:2
		$level->setBlockDataAt($vec->x + 9, 83, $vec->z + 4, 2);
		
		$level->setBlockIdAt($vec->x + 8, 83, $vec->z + 4, 53);#53:2
		$level->setBlockDataAt($vec->x + 8, 83, $vec->z + 4, 2);
		
		$level->setBlockIdAt($vec->x + 7, 83, $vec->z + 4, 53);#53:2
		$level->setBlockDataAt($vec->x + 7, 83, $vec->z + 4, 2);
		
		$level->setBlockIdAt($vec->x + 6, 83, $vec->z + 4, 53);#53:2
		$level->setBlockDataAt($vec->x + 6, 83, $vec->z + 4, 2);
		
		$level->setBlockIdAt($vec->x + 5, 83, $vec->z + 4, 53);#53:2
		$level->setBlockDataAt($vec->x + 5, 83, $vec->z + 4, 2);
		
		$level->setBlockIdAt($vec->x + 4, 83, $vec->z + 4, 53);#53:2
		$level->setBlockDataAt($vec->x + 4, 83, $vec->z + 4, 2);
		
		$level->setBlockIdAt($vec->x + 3, 83, $vec->z + 4, 109);#109:2
		$level->setBlockDataAt($vec->x + 3, 83, $vec->z + 4, 2);
		###
		
		#Lớp 21
		$level->setBlockIdAt($vec->x + 10, 84, $vec->z + 19, 35);
		$level->setBlockIdAt($vec->x + 9, 84, $vec->z + 19, 35);
		
		$level->setBlockIdAt($vec->x + 7, 84, $vec->z + 19, 35);#35:14
		$level->setBlockDataAt($vec->x + 7, 84, $vec->z + 19, 14);
		
		
		$level->setBlockIdAt($vec->x + 9, 84, $vec->z + 18, 35);#35:14
		$level->setBlockDataAt($vec->x + 9, 84, $vec->z + 18, 14);
		
		$level->setBlockIdAt($vec->x + 8, 84, $vec->z + 18, 35);#35:14
		$level->setBlockDataAt($vec->x + 8, 84, $vec->z + 18, 14);
		
		$level->setBlockIdAt($vec->x + 7, 84, $vec->z + 18, 35);#35:6
		$level->setBlockDataAt($vec->x + 7, 84, $vec->z + 18, 6);
		
		$level->setBlockIdAt($vec->x + 6, 84, $vec->z + 18, 35);#35:14
		$level->setBlockDataAt($vec->x + 6, 84, $vec->z + 18, 14);
		
		
		$level->setBlockIdAt($vec->x + 7, 84, $vec->z + 17, 35);#35:14
		$level->setBlockDataAt($vec->x + 7, 84, $vec->z + 17, 14);
		
		$level->setBlockIdAt($vec->x + 6, 84, $vec->z + 17, 35);#35:14
		$level->setBlockDataAt($vec->x + 6, 84, $vec->z + 17, 14);
		
		$level->setBlockIdAt($vec->x + 5, 84, $vec->z + 17, 35);#35:6
		$level->setBlockDataAt($vec->x + 5, 84, $vec->z + 17, 6);
		
		$level->setBlockIdAt($vec->x + 4, 84, $vec->z + 17, 35);#35:6
		$level->setBlockDataAt($vec->x + 4, 84, $vec->z + 17, 6);
		
		
		$level->setBlockIdAt($vec->x + 11, 84, $vec->z + 16, 35);#35:14
		$level->setBlockDataAt($vec->x + 11, 84, $vec->z + 16, 14);
		
		$level->setBlockIdAt($vec->x + 6, 84, $vec->z + 16, 35);#35:14
		$level->setBlockDataAt($vec->x + 6, 84, $vec->z + 16, 14);
		
		$level->setBlockIdAt($vec->x + 5, 84, $vec->z + 16, 35);
		
		$level->setBlockIdAt($vec->x + 12, 84, $vec->z + 15, 35);#35:14
		$level->setBlockDataAt($vec->x + 12, 84, $vec->z + 15, 14);
		
		$level->setBlockIdAt($vec->x + 11, 84, $vec->z + 15, 35);
		$level->setBlockIdAt($vec->x + 11, 84, $vec->z + 15, 35);
		
		$level->setBlockIdAt($vec->x + 7, 84, $vec->z + 15, 35);#35:14
		$level->setBlockDataAt($vec->x + 7, 84, $vec->z + 15, 14);
		
		$level->setBlockIdAt($vec->x + 6, 84, $vec->z + 15, 35);
		$level->setBlockIdAt($vec->x + 5, 84, $vec->z + 15, 35);
		$level->setBlockIdAt($vec->x + 4, 84, $vec->z + 15, 35);
		
		$level->setBlockIdAt($vec->x + 12, 84, $vec->z + 14, 35);#35:14
		$level->setBlockDataAt($vec->x + 12, 84, $vec->z + 14, 14);
		
		$level->setBlockIdAt($vec->x + 8, 84, $vec->z + 14, 17);#17:14
		$level->setBlockDataAt($vec->x + 8, 84, $vec->z + 14, 15);
		
		$level->setBlockIdAt($vec->x + 6, 84, $vec->z + 14, 35);#35:6
		$level->setBlockDataAt($vec->x + 6, 84, $vec->z + 14, 6);
		
		
		$level->setBlockIdAt($vec->x + 14, 84, $vec->z + 13, 35);#35
		$level->setBlockIdAt($vec->x + 13, 84, $vec->z + 13, 35);#35
		$level->setBlockIdAt($vec->x + 12, 84, $vec->z + 13, 35);#35
		
		$level->setBlockIdAt($vec->x + 13, 84, $vec->z + 12, 35);#35
		$level->setBlockIdAt($vec->x + 12, 84, $vec->z + 12, 35);#35
		
		$level->setBlockIdAt($vec->x + 13, 84, $vec->z + 7, 109);#109:3
		$level->setBlockDataAt($vec->x + 13, 84, $vec->z + 7, 3);
		
		$level->setBlockIdAt($vec->x + 12, 84, $vec->z + 7, 53);#53:3
		$level->setBlockDataAt($vec->x + 12, 84, $vec->z + 7, 3);
		
		$level->setBlockIdAt($vec->x + 11, 84, $vec->z + 7, 53);#53:3
		$level->setBlockDataAt($vec->x + 11, 84, $vec->z + 7, 3);
		
		$level->setBlockIdAt($vec->x + 10, 84, $vec->z + 7, 53);#53:3
		$level->setBlockDataAt($vec->x + 10, 84, $vec->z + 7, 3);
		
		$level->setBlockIdAt($vec->x + 9, 84, $vec->z + 7, 53);#53:3
		$level->setBlockDataAt($vec->x + 9, 84, $vec->z + 7, 3);
		
		$level->setBlockIdAt($vec->x + 8, 84, $vec->z + 7, 53);#53:3
		$level->setBlockDataAt($vec->x + 8, 84, $vec->z + 7, 3);
		
		$level->setBlockIdAt($vec->x + 7, 84, $vec->z + 7, 53);#53:3
		$level->setBlockDataAt($vec->x + 7, 84, $vec->z + 7, 3);
		
		$level->setBlockIdAt($vec->x + 6, 84, $vec->z + 7, 53);#53:3
		$level->setBlockDataAt($vec->x + 6, 84, $vec->z + 7, 3);
		
		$level->setBlockIdAt($vec->x + 5, 84, $vec->z + 7, 53);#53:3
		$level->setBlockDataAt($vec->x + 5, 84, $vec->z + 7, 3);
		
		$level->setBlockIdAt($vec->x + 4, 84, $vec->z + 7, 53);#53:3
		$level->setBlockDataAt($vec->x + 4, 84, $vec->z + 7, 3);
		
		$level->setBlockIdAt($vec->x + 3, 84, $vec->z + 7, 109);#109:3
		$level->setBlockDataAt($vec->x + 3, 84, $vec->z + 7, 3);
		
		
		$level->setBlockIdAt($vec->x + 13, 84, $vec->z + 6, 109);#109:5
		$level->setBlockDataAt($vec->x + 13, 84, $vec->z + 6, 5);
		
		$level->setBlockIdAt($vec->x + 12, 84, $vec->z + 6, 17);
		$level->setBlockIdAt($vec->x + 8, 84, $vec->z + 6, 17);
		$level->setBlockIdAt($vec->x + 4, 84, $vec->z + 6, 17);
		
		$level->setBlockIdAt($vec->x + 3, 84, $vec->z + 6, 109);#109:4
		$level->setBlockDataAt($vec->x + 3, 84, $vec->z + 6, 4);
		
		
		$level->setBlockIdAt($vec->x + 13, 84, $vec->z + 5, 109);#109:2
		$level->setBlockDataAt($vec->x + 13, 84, $vec->z + 5, 2);
		
		$level->setBlockIdAt($vec->x + 12, 84, $vec->z + 5, 53);#53:2
		$level->setBlockDataAt($vec->x + 12, 84, $vec->z + 5, 2);
		
		$level->setBlockIdAt($vec->x + 11, 84, $vec->z + 5, 53);#53:2
		$level->setBlockDataAt($vec->x + 11, 84, $vec->z + 5, 2);
		
		$level->setBlockIdAt($vec->x + 10, 84, $vec->z + 5, 53);#53:2
		$level->setBlockDataAt($vec->x + 10, 84, $vec->z + 5, 2);
		
		$level->setBlockIdAt($vec->x + 9, 84, $vec->z + 5, 53);#53:2
		$level->setBlockDataAt($vec->x + 9, 84, $vec->z + 5, 2);
		
		$level->setBlockIdAt($vec->x + 8, 84, $vec->z + 5, 53);#53:2
		$level->setBlockDataAt($vec->x + 8, 84, $vec->z + 5, 2);
		
		$level->setBlockIdAt($vec->x + 7, 84, $vec->z + 5, 53);#53:2
		$level->setBlockDataAt($vec->x + 7, 84, $vec->z + 5, 2);
		
		$level->setBlockIdAt($vec->x + 6, 84, $vec->z + 5, 53);#53:2
		$level->setBlockDataAt($vec->x + 6, 84, $vec->z + 5, 2);
		
		$level->setBlockIdAt($vec->x + 5, 84, $vec->z + 5, 53);#53:2
		$level->setBlockDataAt($vec->x + 5, 84, $vec->z + 5, 2);
		
		$level->setBlockIdAt($vec->x + 4, 84, $vec->z + 5, 53);#53:2
		$level->setBlockDataAt($vec->x + 4, 84, $vec->z + 5, 2);
	
		$level->setBlockIdAt($vec->x + 3, 84, $vec->z + 5, 109);#109:2
		$level->setBlockDataAt($vec->x + 3, 84, $vec->z + 5, 2);
		###
		
		#Lớp 22
		$level->setBlockIdAt($vec->x + 9, 85, $vec->z + 19, 35);#35:6
		$level->setBlockDataAt($vec->x + 9, 85, $vec->z + 19, 6);
		
		$level->setBlockIdAt($vec->x + 6, 85, $vec->z + 17, 35);#35
		
		$level->setBlockIdAt($vec->x + 13, 85, $vec->z + 15, 35);#35
		
		$level->setBlockIdAt($vec->x + 9, 85, $vec->z + 15, 17);#17:15
		$level->setBlockDataAt($vec->x + 9, 85, $vec->z + 15, 15);
		
		$level->setBlockIdAt($vec->x + 9, 85, $vec->z + 15, 17);#17:15
		$level->setBlockDataAt($vec->x + 9, 85, $vec->z + 15, 15);
		
		$level->setBlockIdAt($vec->x + 7, 85, $vec->z + 15, 35);#35:14
		$level->setBlockDataAt($vec->x + 7, 85, $vec->z + 15, 14);
		
		$level->setBlockIdAt($vec->x + 6, 85, $vec->z + 15, 35);#35:14
		$level->setBlockDataAt($vec->x + 6, 85, $vec->z + 15, 14);
		
		
		$level->setBlockIdAt($vec->x + 13, 85, $vec->z + 14, 35);#35:14
		$level->setBlockDataAt($vec->x + 13, 85, $vec->z + 14, 14);
		
		$level->setBlockIdAt($vec->x + 9, 85, $vec->z + 14, 35);#35:14
		$level->setBlockDataAt($vec->x + 9, 85, $vec->z + 14, 14);
		
		$level->setBlockIdAt($vec->x + 8, 85, $vec->z + 14, 17);#17:15
		$level->setBlockDataAt($vec->x + 8, 85, $vec->z + 14, 15);
		
		$level->setBlockIdAt($vec->x + 7, 85, $vec->z + 14, 35);#35:6
		$level->setBlockDataAt($vec->x + 7, 85, $vec->z + 14, 6);
		
		$level->setBlockIdAt($vec->x + 14, 85, $vec->z + 13, 35);#35
		
		$level->setBlockIdAt($vec->x + 12, 85, $vec->z + 12, 35);#35:14
		$level->setBlockDataAt($vec->x + 12, 85, $vec->z + 12, 14);
		
		$level->setBlockIdAt($vec->x + 11, 85, $vec->z + 12, 35);#35
		
		$level->setBlockIdAt($vec->x + 8, 85, $vec->z + 12, 35);#35:14
		$level->setBlockDataAt($vec->x + 8, 85, $vec->z + 12, 14);
		
		
		$level->setBlockIdAt($vec->x + 14, 85, $vec->z + 11, 35);#35:14
		$level->setBlockDataAt($vec->x + 14, 85, $vec->z + 11, 14);
		
		$level->setBlockIdAt($vec->x + 11, 85, $vec->z + 11, 35);#35:6
		$level->setBlockDataAt($vec->x + 11, 85, $vec->z + 11, 6);
		
		
		$level->setBlockIdAt($vec->x + 13, 85, $vec->z + 6, 44);#44:5
		$level->setBlockDataAt($vec->x + 13, 85, $vec->z + 6, 5);
		
		$level->setBlockIdAt($vec->x + 12, 85, $vec->z + 6, 44);#44:5
		$level->setBlockDataAt($vec->x + 12, 85, $vec->z + 6, 5);
		
		$level->setBlockIdAt($vec->x + 11, 85, $vec->z + 6, 44);#44:5
		$level->setBlockDataAt($vec->x + 11, 85, $vec->z + 6, 5);
		
		$level->setBlockIdAt($vec->x + 10, 85, $vec->z + 6, 44);#44:5
		$level->setBlockDataAt($vec->x + 10, 85, $vec->z + 6, 5);
		
		$level->setBlockIdAt($vec->x + 9, 85, $vec->z + 6, 44);#44:5
		$level->setBlockDataAt($vec->x + 9, 85, $vec->z + 6, 5);
		
		$level->setBlockIdAt($vec->x + 8, 85, $vec->z + 6, 44);#44:5
		$level->setBlockDataAt($vec->x + 8, 85, $vec->z + 6, 5);
		
		$level->setBlockIdAt($vec->x + 7, 85, $vec->z + 6, 44);#44:5
		$level->setBlockDataAt($vec->x + 7, 85, $vec->z + 6, 5);
		
		$level->setBlockIdAt($vec->x + 6, 85, $vec->z + 6, 44);#44:5
		$level->setBlockDataAt($vec->x + 6, 85, $vec->z + 6, 5);
		
		$level->setBlockIdAt($vec->x + 5, 85, $vec->z + 6, 44);#44:5
		$level->setBlockDataAt($vec->x + 5, 85, $vec->z + 6, 5);
		
		$level->setBlockIdAt($vec->x + 4, 85, $vec->z + 6, 44);#44:5
		$level->setBlockDataAt($vec->x + 4, 85, $vec->z + 6, 5);
		
		$level->setBlockIdAt($vec->x + 3, 85, $vec->z + 6, 44);#44:5
		$level->setBlockDataAt($vec->x + 3, 85, $vec->z + 6, 5);
		###
		
		#Lớp 23
		$level->setBlockIdAt($vec->x + 14, 86, $vec->z + 16, 35);#35:14
		$level->setBlockDataAt($vec->x + 14, 86, $vec->z + 16, 14);
		
		$level->setBlockIdAt($vec->x + 14, 86, $vec->z + 15, 35);#35:14
		$level->setBlockDataAt($vec->x + 14, 86, $vec->z + 15, 14);
		
		$level->setBlockIdAt($vec->x + 12, 86, $vec->z + 15, 35);#35
		
		$level->setBlockIdAt($vec->x + 9, 86, $vec->z + 15, 17);#17:15
		$level->setBlockDataAt($vec->x + 9, 86, $vec->z + 15, 15);
		
		$level->setBlockIdAt($vec->x + 9, 86, $vec->z + 14, 35);#35:6
		$level->setBlockDataAt($vec->x + 9, 86, $vec->z + 14, 6);
		
		$level->setBlockIdAt($vec->x + 8, 86, $vec->z + 14, 35);#35:6
		$level->setBlockDataAt($vec->x + 8, 86, $vec->z + 14, 6);
		
		$level->setBlockIdAt($vec->x + 9, 86, $vec->z + 13, 35);#35:6
		$level->setBlockDataAt($vec->x + 9, 86, $vec->z + 13, 6);
		
		$level->setBlockIdAt($vec->x + 8, 86, $vec->z + 13, 35);#35:6
		$level->setBlockDataAt($vec->x + 8, 86, $vec->z + 13, 6);
		
		$level->setBlockIdAt($vec->x + 7, 86, $vec->z + 13, 35);#35:14
		$level->setBlockDataAt($vec->x + 7, 86, $vec->z + 13, 14);
		
		$level->setBlockIdAt($vec->x + 8, 86, $vec->z + 12, 35);#35:6
		$level->setBlockDataAt($vec->x + 8, 86, $vec->z + 12, 6);
		
		$level->setBlockIdAt($vec->x + 11, 86, $vec->z + 11, 35);#35:14
		$level->setBlockDataAt($vec->x + 11, 86, $vec->z + 11, 14);
		
		$level->setBlockIdAt($vec->x + 11, 86, $vec->z + 10, 35);#35:6
		$level->setBlockDataAt($vec->x + 11, 86, $vec->z + 10, 6);
		###
		
		#Lớp 24
		$level->setBlockIdAt($vec->x + 11, 87, $vec->z + 18, 35);#35
		
		$level->setBlockIdAt($vec->x + 14, 87, $vec->z + 17, 35);#35
		
		$level->setBlockIdAt($vec->x + 13, 87, $vec->z + 17, 35);#35:6
		$level->setBlockDataAt($vec->x + 13, 87, $vec->z + 17, 6);
		
		$level->setBlockIdAt($vec->x + 9, 87, $vec->z + 16, 17);#17:15
		$level->setBlockDataAt($vec->x + 9, 87, $vec->z + 16, 15);
		
		$level->setBlockIdAt($vec->x + 8, 87, $vec->z + 16, 35);#35
		
		$level->setBlockIdAt($vec->x + 12, 87, $vec->z + 15, 35);#35:6
		$level->setBlockDataAt($vec->x + 12, 87, $vec->z + 15, 6);
		
		$level->setBlockIdAt($vec->x + 11, 87, $vec->z + 15, 35);#35:14
		$level->setBlockDataAt($vec->x + 11, 87, $vec->z + 15, 14);
		
		$level->setBlockIdAt($vec->x + 10, 87, $vec->z + 15, 35);#35:14
		$level->setBlockDataAt($vec->x + 10, 87, $vec->z + 15, 14);
		
		$level->setBlockIdAt($vec->x + 9, 87, $vec->z + 15, 17);#17:15
		$level->setBlockDataAt($vec->x + 9, 87, $vec->z + 15, 15);
		
		$level->setBlockIdAt($vec->x + 7, 87, $vec->z + 13, 35);#35:14
		$level->setBlockDataAt($vec->x + 7, 87, $vec->z + 13, 14);
		###
		
		#Lớp 25
		$level->setBlockIdAt($vec->x + 11, 88, $vec->z + 18, 35);#35:6
		$level->setBlockDataAt($vec->x + 11, 88, $vec->z + 18, 6);
		
		$level->setBlockIdAt($vec->x + 7, 88, $vec->z + 18, 35);#35:6
		$level->setBlockDataAt($vec->x + 7, 88, $vec->z + 18, 6);
		
		$level->setBlockIdAt($vec->x + 11, 88, $vec->z + 17, 35);#35
		
		$level->setBlockIdAt($vec->x + 10, 88, $vec->z + 17, 35);#35:6
		$level->setBlockDataAt($vec->x + 10, 88, $vec->z + 17, 6);
		
		$level->setBlockIdAt($vec->x + 11, 88, $vec->z + 16, 35);#35
		$level->setBlockIdAt($vec->x + 10, 88, $vec->z + 16, 35);#35
		
		$level->setBlockIdAt($vec->x + 9, 88, $vec->z + 16, 17);#17:15
		$level->setBlockDataAt($vec->x + 9, 88, $vec->z + 16, 15);
		
		$level->setBlockIdAt($vec->x + 8, 88, $vec->z + 16, 35);#35:14
		$level->setBlockDataAt($vec->x + 8, 88, $vec->z + 16, 14);
		
		$level->setBlockIdAt($vec->x + 7, 88, $vec->z + 16, 35);#35:14
		$level->setBlockDataAt($vec->x + 7, 88, $vec->z + 16, 14);
		
		$level->setBlockIdAt($vec->x + 10, 88, $vec->z + 15, 35);#35:14
		$level->setBlockDataAt($vec->x + 10, 88, $vec->z + 15, 14);
		
		$level->setBlockIdAt($vec->x + 9, 88, $vec->z + 15, 35);#35:6
		$level->setBlockDataAt($vec->x + 9, 88, $vec->z + 15, 6);
		
		$level->setBlockIdAt($vec->x + 5, 88, $vec->z + 15, 35);#35:6
		$level->setBlockDataAt($vec->x + 5, 88, $vec->z + 15, 6);
		###
		
		#Lớp 26
		$level->setBlockIdAt($vec->x + 7, 89, $vec->z + 18, 35);#35
		
		$level->setBlockIdAt($vec->x + 9, 89, $vec->z + 16, 17);#17:15
		$level->setBlockDataAt($vec->x + 9, 89, $vec->z + 16, 15);
		
		$level->setBlockIdAt($vec->x + 7, 89, $vec->z + 16, 35);#35:6
		$level->setBlockDataAt($vec->x + 7, 89, $vec->z + 16, 6);
		
		$level->setBlockIdAt($vec->x + 6, 89, $vec->z + 16, 35);#35:6
		$level->setBlockDataAt($vec->x + 6, 89, $vec->z + 16, 6);
		
		$level->setBlockIdAt($vec->x + 6, 89, $vec->z + 15, 35);#35:14
		$level->setBlockDataAt($vec->x + 6, 89, $vec->z + 15, 14);
		
		$level->setBlockIdAt($vec->x + 5, 89, $vec->z + 15, 35);#35:6
		$level->setBlockDataAt($vec->x + 5, 89, $vec->z + 15, 6);

		$level->setBlockIdAt($vec->x + 9, 89, $vec->z + 13, 35);#35:6
		$level->setBlockDataAt($vec->x + 9, 89, $vec->z + 13, 6);
		###
		
		#Lớp 27
		$level->setBlockIdAt($vec->x + 8, 90, $vec->z + 18, 35);#35
		
		$level->setBlockIdAt($vec->x + 7, 90, $vec->z + 18, 35);#35:14
		$level->setBlockDataAt($vec->x + 7, 90, $vec->z + 18, 14);
		
		$level->setBlockIdAt($vec->x + 10, 90, $vec->z + 17, 35);
		
		$level->setBlockIdAt($vec->x + 9, 90, $vec->z + 17, 35);#35:6
		$level->setBlockDataAt($vec->x + 9, 90, $vec->z + 17, 6);
		
		$level->setBlockIdAt($vec->x + 8, 90, $vec->z + 17, 35);#35:14
		$level->setBlockDataAt($vec->x + 8, 90, $vec->z + 17, 14);
		
		$level->setBlockIdAt($vec->x + 7, 90, $vec->z + 17, 35);#35:14
		$level->setBlockDataAt($vec->x + 7, 90, $vec->z + 17, 14);
		
		$level->setBlockIdAt($vec->x + 10, 90, $vec->z + 16, 35);#35:6
		$level->setBlockDataAt($vec->x + 10, 90, $vec->z + 16, 6);
		
		$level->setBlockIdAt($vec->x + 9, 90, $vec->z + 16, 35);
		$level->setBlockDataAt($vec->x + 8, 90, $vec->z + 16, 35);
		
		$level->setBlockIdAt($vec->x + 8, 90, $vec->z + 15, 35);#35:6
		$level->setBlockDataAt($vec->x + 8, 90, $vec->z + 15, 6);
		
		$level->setBlockIdAt($vec->x + 8, 90, $vec->z + 14, 35);#35:6
		$level->setBlockDataAt($vec->x + 8, 90, $vec->z + 14, 6);
		
		$level->setBlockIdAt($vec->x + 8, 90, $vec->z + 13, 35);#35:14
		$level->setBlockDataAt($vec->x + 8, 90, $vec->z + 13, 14);
		###
		
		#Lớp 28
		$level->setBlockIdAt($vec->x + 10, 91, $vec->z + 16, 35);#35:6
		$level->setBlockDataAt($vec->x + 10, 91, $vec->z + 16, 6);
		
		$level->setBlockIdAt($vec->x + 9, 91, $vec->z + 16, 35);#35:14
		$level->setBlockDataAt($vec->x + 9, 91, $vec->z + 16, 14);
		
		$level->setBlockIdAt($vec->x + 10, 91, $vec->z + 15, 35);
		
		$level->setBlockIdAt($vec->x + 9, 91, $vec->z + 15, 35);#35:6
		$level->setBlockDataAt($vec->x + 9, 91, $vec->z + 15, 6);
		
		$level->setBlockIdAt($vec->x + 9, 91, $vec->z + 14, 35);
	}

	public function populate(ChunkManager $level, $chunkX, $chunkZ, Random $random){
		$chunk = $level->getChunk($chunkX, $chunkZ);
		$shape = $this->generator->getShape($chunkX << 4, $chunkZ << 4);
		for($Z = 0; $Z < 16; ++$Z){
			for($X = 0; $X < 16; ++$X){
				$type = $shape[($Z << 4) | $X];
				if($type === MyPlotGenerator::ISLAND){
					self::placeObject($level, $chunk, $X, $Z);
				}
			}
		}
	}
}