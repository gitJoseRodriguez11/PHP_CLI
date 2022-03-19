<?PHP
ini_set('memory_limit', 134217728);
ini_set('mysql.connect_timeout', 14400);
ini_set('default_socket_timeout', 14400);
ini_set('max_execution_time', 0);

class Queries
{
    private static $logger;
    private static $dB;
    function __construct($logger, $dB)
    {
        SELF::$logger = $logger;
        SELF::$dB = $dB;
    }

    public function getHabilitados(){
        try {
            $queryStart = 0;
            $queryEnd = 0;
            $queryStart = microtime(true);
             
			$sql = "SELECT * FROM alumno WHERE habilitado = 1";
            SELF::$logger->log('INICIA QUERY :: ' . $sql . '<br>');

            $query = SELF::$dB->prepare($sql);

            $query->execute();
			
			$data = [];
			
            if ($query->rowCount() > 0) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
				$data[] = $result;  
               // return $result;
            } else {
                return false;
            }
			
			/*Crear una función que en base al 2° parametro de la ejecución genere un JSON 
			con los alumnos habilitados o los inhabilitados. */
			
			return json_encode($data);
			
        } catch (PDOException $p) {
            SELF::$logger->log('<br><br> ERROR3: EN LA CONSULTA A LA BASE DE DATOS DE ORIGEN: ' . $p, 1);
            exit(1);
        } finally {
            $queryEnd = microtime(true);
            SELF::$logger->log('<br><br> TERMINA QUERY :: ' . $sql);
            $queryDuration = $queryEnd - $queryStart;
            SELF::$logger->log('<br><br> DURACIÓN : ' . SELF::$logger->conversorSegundosHoras($queryDuration));
        }
    }
	
	
	public function getStudents2($schoolID){
        try {
            $queryStart = 0;
            $queryEnd = 0;
            $queryStart = microtime(true);
            $sql = "SELECT * FROM alumno WHERE colegio = :schoolID LIMIT 10;";
            SELF::$logger->log('INICIA QUERY :: ' . $sql);

            $query = SELF::$dB->prepare($sql);

            if (!$query) {
                SELF::$logger->log('ERROR: ' . SELF::$dB->errorInfo(), 1);
                throw new Exception('ERROR: ' . SELF::$dB->errorInfo());
            }
            $query->bindParam(':schoolID', $schoolID, PDO::PARAM_INT);
            $query->execute();
            if ($query->rowCount() > 0) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } else {
                return false;
            }
        } catch (PDOException $p) {
            SELF::$logger->log('ERROR: EN LA CONSULTA A LA BASE DE DATOS DE ORIGEN: ' . $p, 1);
            exit(1);
        } finally {
            $queryEnd = microtime(true);
            SELF::$logger->log('TERMINA QUERY :: ' . $sql);
            $queryDuration = $queryEnd - $queryStart;
            SELF::$logger->log('DURACIÓN : ' . SELF::$logger->conversorSegundosHoras($queryDuration));
        }
    }
	
	/*Crear una función que en base al 3° parametro de la ejecución genere un JSON con los alumnos 
	del id del curso indicado.*/
	
	public function getIdCurso($cursoID){
        try {
            $queryStart = 0;
            $queryEnd = 0;
            $queryStart = microtime(true);
            $sql = "SELECT * FROM alumno WHERE curso = :cursoID;";
            SELF::$logger->log('INICIA QUERY :: ' . $sql);

            $query = SELF::$dB->prepare($sql);

            if (!$query) {
                SELF::$logger->log('ERROR: ' . SELF::$dB->errorInfo(), 1);
                throw new Exception('ERROR: ' . SELF::$dB->errorInfo());
            }
            $query->bindParam(':cursoID', $cursoID, PDO::PARAM_INT);
            $query->execute();
            if ($query->rowCount() > 0) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                $data[] = $result;
            } else {
                return false;
            }
			
			if ($query->rowCount() > 0) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
				$data[] = $result;  
            } else {
                return false;
            }
			
			return json_encode($data);
			
        } catch (PDOException $p) {
            SELF::$logger->log('ERROR: EN LA CONSULTA A LA BASE DE DATOS DE ORIGEN: ' . $p, 1);
            exit(1);
        } finally {
            $queryEnd = microtime(true);
            SELF::$logger->log('TERMINA QUERY :: ' . $sql);
            $queryDuration = $queryEnd - $queryStart;
            SELF::$logger->log('DURACIÓN : ' . SELF::$logger->conversorSegundosHoras($queryDuration));
        }
    }
}
