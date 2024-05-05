
class JeuHanoi {
	public static void main(String[] args) {
		int taille = 3;
		Hanoi h = new Hanoi(taille);
		h.afficher();
		h.hanoi(taille, 0, 2);
	}
}



class Hanoi {
	private Pilier [] piliers = new Pilier[3];
	private int size;

	public Hanoi(int taille) {
		size = taille;
		boolean vide = true;
		piliers[0] = new Pilier(size, !vide);
		piliers[1] = new Pilier(size, vide);
		piliers[2] = new Pilier(size, vide);
	}

	
	public void afficher() {
		// Affiche les piliers
		for (int i = 0; i < size; i++) {
			piliers[0].getDisque(i).afficher();
			piliers[1].getDisque(i).afficher();
			piliers[2].getDisque(i).afficher();
			System.out.println();
		}

		// Affiche le socle
		Utils.afficherCaractere('#', 6 * size - 1);
		System.out.println();
		System.out.println();
	}

	/**
	 * DÃ©place le disque placÃ© au sommet du pilier d'origine
	 * jusqu'au sommet du pilier destination
	 */
	private void deplacer(int origine, int destination) {
		Pilier orig = piliers[origine];
		Pilier dest = piliers[destination];
		int top1 = orig.sommet();
		int top2 = dest.sommet();
		Disque d = orig.getDisque(top1);
		if (top1 < size) {
			orig.setDisque(top1, new Disque(0, size));
			dest.setDisque(top2 - 1, d);
		}
	}

	/**
	 * La mÃ©thode rÃ©cursive principale
	 */
	public void hanoi(int nombre, int origine, int destination) {
		if (nombre != 0) {
			int auxiliaire = autre(origine, destination);
			hanoi(nombre - 1, origine, auxiliaire);
			this.deplacer(origine, destination);
			this.afficher();
			hanoi(nombre - 1, auxiliaire, destination);
		}
	}

	/**
	 * Petite mÃ©thode utilitaire permettant de determiner
	 * l'indice du pilier autre que i ou j
	 */
	static private int autre(int i, int j) {
		return (3 - i - j);
	}
}

/**
 * La classe pour reprÃ©senter les piliers
 */
class Pilier {
	private int size;
	// Un pilier peut contenir au plus N disques
	private Disque[] pilier;

	public Pilier(int size, boolean vide) {
		this.size = size;
		pilier = new Disque[size];
		this.empilerDisques(size, vide);
	}

	private void empilerDisques(int size, boolean vide) {
		for (int i = 0; i < size; i++) {
			if (vide) {
				pilier[i] = new Disque(0, size);
			} else {
				pilier[i] = new Disque(i + 1, size);
			}
		}
	}

	public Disque getDisque(int i) {
		// afin de ne pas retourner une rÃ©fÃ©rence Ã  un objet privÃ© et mutable
		return new Disque(pilier[i]);
	}

	public void setDisque(int i, Disque d) {
		pilier[i] = d;
	}

	public int sommet() {
		int top;
		for (top = 0; (top < size) && (pilier[top].getTailleDisque() == 0); top++) {
			;
		}
		return top;
	}

}

/**
 * La classe pour reprÃ©senter les disques
 */
class Disque {
	// Un disque est reprÃ©sentÃ© par sa taille
	private int tailleDisque;
	private int tailleJeu;

	public Disque(int tailleDisque, int tailleJeu) {
		this.tailleDisque = tailleDisque;
		this.tailleJeu = tailleJeu;
	}

	public Disque(Disque autreDisque)
		{
			tailleDisque = autreDisque.tailleDisque;
			tailleJeu = autreDisque.tailleJeu;
		}
	
	public void afficher() {
		if (getTailleDisque() == 0) {
			Utils.afficherCaractere(' ', tailleJeu - 1);
			System.out.print('|');
			Utils.afficherCaractere(' ', tailleJeu);
		} else {
			Utils.afficherCaractere(' ', tailleJeu - getTailleDisque());
			Utils.afficherCaractere('-', 2 * getTailleDisque() - 1);
			Utils.afficherCaractere(' ', tailleJeu - getTailleDisque() + 1);
		}
	}

	public int getTailleDisque() {
		return tailleDisque;
	}
}

// Une classe oÃ¹ vous pouvez mettre plein d'autres
// petite mÃ©thodes utilitaire.
class Utils {
	/**
	 * Affiche n fois le caractÃ¨re c.
	 * @param c Le caractÃ¨re Ã  afficher
	 * @param n Le nombre de rÃ©pÃ©titions
	 */
	static void afficherCaractere(char c, int n) {
		for (int i = 0; i < n; i++) {
			System.out.print(c);
		}
	}
}