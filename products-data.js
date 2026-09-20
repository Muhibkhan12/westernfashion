// The Western Fashion — shared product catalog
// Loaded by both products.html and product.html so the two pages stay in sync.

const PRODUCTS = [
  {
    id: "camel-wool-jacket",
    name: "Camel Wool Jacket",
    brand: "The Western Fashion",
    price: 400,
    oldPrice: 450,
    badge: "Sale",
    cat: "wool",
    rating: 5,
    reviewCount: 41,
    colors: [
      { name: "Ink", hex: "#1C1A16" },
      { name: "Slate Blue", hex: "#3B5BA5" },
      { name: "Brick", hex: "#9A3D28" }
    ],
    sizes: ["XS", "S", "M", "L", "XL"],
    images: [
      "https://images.unsplash.com/photo-1544923246-77307dd654cb?q=80&w=1000&auto=format&fit=crop",
      "https://images.unsplash.com/photo-1591047139829-d91aecb6caea?q=80&w=1000&auto=format&fit=crop",
      "https://images.unsplash.com/photo-1521223890158-f9f7c3d5d504?q=80&w=1000&auto=format&fit=crop"
    ],
    short: "A heavyweight camel wool jacket cut for cold mornings and worn-in comfort.",
    description: "Cut from a heavyweight camel wool we source from a mill we've worked with for close to a decade, this jacket is built for the months when a shell isn't enough. The shoulder is left unstructured so it moves with you instead of against you, and the collar sits high enough to stand in for a scarf on the short walk to the train. We line the body in brushed cotton twill, which softens with every wear rather than pilling the way synthetic linings tend to.",
    details: [
      "100% camel wool shell, brushed cotton twill lining",
      "Unstructured shoulder, notched lapel collar",
      "Interior chest pocket, welt hip pockets",
      "Horn-style buttons, dry clean only",
      "Cut true to size — size up for a roomier fit"
    ]
  },
  {
    id: "quilted-field-jacket",
    name: "Quilted Field Jacket",
    brand: "The Western Fashion",
    price: 400,
    oldPrice: 450,
    badge: "Sale",
    cat: "field",
    rating: 5,
    reviewCount: 28,
    colors: [
      { name: "Ink", hex: "#1C1A16" },
      { name: "Slate Blue", hex: "#3B5BA5" }
    ],
    sizes: ["S", "M", "L", "XL"],
    images: [
      "https://images.unsplash.com/photo-1551028719-00167b16eac5?q=80&w=1000&auto=format&fit=crop",
      "https://images.unsplash.com/photo-1548624149-f9061a9a2151?q=80&w=1000&auto=format&fit=crop",
      "https://images.unsplash.com/photo-1544966503-7ba532cb2513?q=80&w=1000&auto=format&fit=crop"
    ],
    short: "A diamond-quilted field jacket with just enough insulation for three-season wear.",
    description: "We built this around a diamond quilting pattern that traps warmth without the bulk of a puffer, so it layers under a heavier coat in January and stands on its own in October. The outer shell is a tight cotton-nylon weave that sheds light rain and wind, and the four patch pockets are sized to actually hold something — gloves, a paperback, a set of keys — rather than sit flat for show.", 
    details: [
      "Cotton-nylon shell, diamond-quilted synthetic fill",
      "Four patch pockets with brass snap closures",
      "Storm flap over front zip",
      "Machine washable, cold and gentle",
      "Runs true to size"
    ]
  },
  {
    id: "cropped-leather-jacket",
    name: "Cropped Leather Jacket",
    brand: "The Western Fashion",
    price: 400,
    oldPrice: null,
    badge: "Sold out",
    cat: "leather",
    rating: 5,
    reviewCount: 63,
    colors: [
      { name: "Ink", hex: "#1C1A16" },
      { name: "Brick", hex: "#9A3D28" }
    ],
    sizes: ["XS", "S", "M", "L"],
    images: [
      "https://images.unsplash.com/photo-1521223890158-f9f7c3d5d504?q=80&w=1000&auto=format&fit=crop",
      "https://images.unsplash.com/photo-1544441893-675973e31985?q=80&w=1000&auto=format&fit=crop",
      "https://images.unsplash.com/photo-1611312449408-fcece27cdbb7?q=80&w=1000&auto=format&fit=crop"
    ],
    short: "Our best-selling silhouette, cropped at the waist with a vegetable-tanned finish.",
    description: "The jacket that started the workshop, still cut from the same vegetable-tanned hide and still finished by hand in small batches. It's cropped to sit right at the waist, with a boxier body than a typical moto so it layers over a sweater without pulling at the shoulders. The leather arrives with some stiffness and breaks in over the first few wears into a fit that's closer to a second skin than outerwear.",
    details: [
      "Vegetable-tanned cowhide, cotton twill lining",
      "Asymmetric front zip, snap lapels",
      "Two hand pockets, one interior zip pocket",
      "Wipe clean, professional leather care recommended",
      "Fits small — we recommend sizing up"
    ]
  },
  {
    id: "denim-trucker-jacket",
    name: "Denim Trucker Jacket",
    brand: "The Western Fashion",
    price: 400,
    oldPrice: 450,
    badge: "Sale",
    cat: "denim",
    rating: 4,
    reviewCount: 19,
    colors: [
      { name: "Ink", hex: "#1C1A16" },
      { name: "Brick", hex: "#9A3D28" }
    ],
    sizes: ["S", "M", "L", "XL"],
    images: [
      "https://images.unsplash.com/photo-1611312449408-fcece27cdbb7?q=80&w=1000&auto=format&fit=crop",
      "https://images.unsplash.com/photo-1544966503-7ba532cb2513?q=80&w=1000&auto=format&fit=crop",
      "https://images.unsplash.com/photo-1591047139829-d91aecb6caea?q=80&w=1000&auto=format&fit=crop"
    ],
    short: "A rigid selvedge trucker built to fade the way old denim should.",
    description: "Made from a 13oz rigid selvedge denim, this trucker is cut close through the body with a straight hem and a two-button adjustable waist. It's stiff out of the box on purpose — the fabric is meant to break in around your own movement and pick up creases that are yours alone. We kept the yoke seam double-stitched and left the pocket bags unbranded, so the only thing you're paying for is the cloth and the construction.",
    details: [
      "13oz rigid selvedge denim, unwashed",
      "Chest flap pockets, two-button adjustable waist",
      "Copper rivets and buttons",
      "Wash cold, inside out, air dry",
      "Sizing runs slightly large"
    ]
  },
  {
    id: "shearling-aviator-jacket",
    name: "Shearling Aviator Jacket",
    brand: "The Western Fashion",
    price: 480,
    oldPrice: null,
    badge: null,
    cat: "leather",
    rating: 5,
    reviewCount: 34,
    colors: [
      { name: "Ink", hex: "#1C1A16" },
      { name: "Slate Blue", hex: "#3B5BA5" },
      { name: "Brick", hex: "#9A3D28" }
    ],
    sizes: ["S", "M", "L", "XL"],
    images: [
      "https://images.unsplash.com/photo-1544441893-675973e31985?q=80&w=1000&auto=format&fit=crop",
      "https://images.unsplash.com/photo-1548624149-f9061a9a2151?q=80&w=1000&auto=format&fit=crop",
      "https://images.unsplash.com/photo-1521223890158-f9f7c3d5d504?q=80&w=1000&auto=format&fit=crop"
    ],
    short: "Full shearling lining under a suede shell, built for the coldest weeks of the year.",
    description: "This is the jacket we make the least of, because full shearling takes longer to source and longer to finish than anything else in the workshop. The suede shell is lined edge to edge in genuine shearling, including the collar, which is cut deep enough to turn up against real wind. It's heavier than everything else we make, and it's meant to be — this is a jacket for the coldest six weeks of the year, not an everyday layer.",
    details: [
      "Suede shell, full genuine shearling lining",
      "Turn-up collar, belted waist",
      "Two hand pockets with shearling trim",
      "Professional leather and fur care only",
      "Cut generously to allow for layering underneath"
    ]
  },
  {
    id: "oversized-wool-jacket",
    name: "Oversized Wool Jacket",
    brand: "The Western Fashion",
    price: 420,
    oldPrice: null,
    badge: "New",
    cat: "wool",
    rating: 5,
    reviewCount: 12,
    colors: [
      { name: "Ink", hex: "#1C1A16" },
      { name: "Slate Blue", hex: "#3B5BA5" },
      { name: "Brick", hex: "#9A3D28" }
    ],
    sizes: ["XS", "S", "M", "L", "XL"],
    images: [
      "https://images.unsplash.com/photo-1591047139829-d91aecb6caea?q=80&w=1000&auto=format&fit=crop",
      "https://images.unsplash.com/photo-1544923246-77307dd654cb?q=80&w=1000&auto=format&fit=crop",
      "https://images.unsplash.com/photo-1611312449408-fcece27cdbb7?q=80&w=1000&auto=format&fit=crop"
    ],
    short: "A dropped-shoulder wool jacket meant to be worn open over almost anything.",
    description: "This one is cut a full size larger through the body and sleeve than the rest of the wool line, with a dropped shoulder seam that gives it the drape of a coat someone handed down to you. It's meant to be worn open more often than closed, over a hoodie as easily as a shirt. The wool has a slight brushed nap to it, so it reads soft rather than formal even at this weight.",
    details: [
      "Brushed wool-blend shell, dropped shoulder seam",
      "Oversized fit — consider sizing down if in between",
      "Patch hip pockets, single interior pocket",
      "Dry clean recommended",
      "New arrival — limited first run"
    ]
  },
  {
    id: "waxed-cotton-field-jacket",
    name: "Waxed Cotton Field Jacket",
    brand: "The Western Fashion",
    price: 400,
    oldPrice: 450,
    badge: "Sold out",
    cat: "field",
    rating: 4,
    reviewCount: 22,
    colors: [
      { name: "Ink", hex: "#1C1A16" },
      { name: "Bone", hex: "#EDE9E3" }
    ],
    sizes: ["S", "M", "L"],
    images: [
      "https://images.unsplash.com/photo-1548624149-f9061a9a2151?q=80&w=1000&auto=format&fit=crop",
      "https://images.unsplash.com/photo-1551028719-00167b16eac5?q=80&w=1000&auto=format&fit=crop",
      "https://images.unsplash.com/photo-1544966503-7ba532cb2513?q=80&w=1000&auto=format&fit=crop"
    ],
    short: "A traditional waxed cotton field jacket, corduroy-collared and built to re-wax for life.",
    description: "Waxed cotton is one of the oldest ways to waterproof a jacket without a membrane, and it's still the one we trust most for genuinely wet weather. This cut keeps the traditional four-pocket field layout and a corduroy under-collar that softens the wax against your neck. The finish will crack and lighten at the fold lines over years of wear — that's expected, and the jacket can be re-waxed at home to bring it back.",
    details: [
      "Waxed cotton shell, corduroy under-collar",
      "Four bellows pockets, storm flap front",
      "Check-lined interior, brass hardware",
      "Spot clean only — do not machine wash",
      "Re-waxing kit available separately"
    ]
  },
  {
    id: "classic-denim-jacket",
    name: "Classic Denim Jacket",
    brand: "The Western Fashion",
    price: 380,
    oldPrice: null,
    badge: null,
    cat: "denim",
    rating: 4,
    reviewCount: 17,
    colors: [
      { name: "Ink", hex: "#1C1A16" },
      { name: "Brick", hex: "#9A3D28" }
    ],
    sizes: ["XS", "S", "M", "L", "XL"],
    images: [
      "https://images.unsplash.com/photo-1544966503-7ba532cb2513?q=80&w=1000&auto=format&fit=crop",
      "https://images.unsplash.com/photo-1611312449408-fcece27cdbb7?q=80&w=1000&auto=format&fit=crop",
      "https://images.unsplash.com/photo-1591047139829-d91aecb6caea?q=80&w=1000&auto=format&fit=crop"
    ],
    short: "A lighter, pre-washed take on the trucker for everyday layering.",
    description: "Where our trucker is left rigid and unwashed, this one is pre-washed to a softer 11oz denim that's ready to wear from the first day. It's a more forgiving jacket for everyday layering — over a t-shirt in spring, under a coat in winter — and the lighter weight means it doesn't fight with whatever you're wearing underneath.",
    details: [
      "11oz pre-washed cotton denim",
      "Two chest pockets, two hand pockets",
      "Adjustable button cuffs",
      "Machine washable, cold",
      "True to size"
    ]
  },
  {
    id: "belted-trench-jacket",
    name: "Belted Trench Jacket",
    brand: "The Western Fashion",
    price: 390,
    oldPrice: null,
    badge: "New",
    cat: "field",
    rating: 5,
    reviewCount: 9,
    colors: [
      { name: "Ink", hex: "#1C1A16" },
      { name: "Bone", hex: "#EDE9E3" }
    ],
    sizes: ["XS", "S", "M", "L"],
    images: [
      "https://images.unsplash.com/photo-1548624149-f9061a9a2151?q=80&w=1000&auto=format&fit=crop",
      "https://images.unsplash.com/photo-1544966503-7ba532cb2513?q=80&w=1000&auto=format&fit=crop",
      "https://images.unsplash.com/photo-1521223890158-f9f7c3d5d504?q=80&w=1000&auto=format&fit=crop"
    ],
    short: "A shortened, jacket-length trench with a self-belt and storm shoulder.",
    description: "We took the trench down to jacket length and kept the details that actually earn their place — the storm shoulder, the self-belt, the deep cuffs you can fold back. It sits somewhere between a field jacket and outerwear you'd wear to dinner, which makes it one of the more versatile pieces in the shop. Worn open, the belt hangs loose at the hip; cinched, it holds a proper shape.",
    details: [
      "Cotton-blend gabardine shell",
      "Self-belt with metal buckle, storm shoulder",
      "Two flap pockets, button-through front",
      "Dry clean only",
      "New arrival — limited first run"
    ]
  },
  {
    id: "quilted-puffer-jacket",
    name: "Quilted Puffer Jacket",
    brand: "The Western Fashion",
    price: 260,
    oldPrice: null,
    badge: "New",
    cat: "field",
    rating: 4,
    reviewCount: 6,
    colors: [
      { name: "Ink", hex: "#1C1A16" },
      { name: "Slate Blue", hex: "#3B5BA5" },
      { name: "Brick", hex: "#9A3D28" }
    ],
    sizes: ["S", "M", "L", "XL"],
    images: [
      "https://images.unsplash.com/photo-1551028719-00167b16eac5?q=80&w=1000&auto=format&fit=crop",
      "https://images.unsplash.com/photo-1591047139829-d91aecb6caea?q=80&w=1000&auto=format&fit=crop",
      "https://images.unsplash.com/photo-1548624149-f9061a9a2151?q=80&w=1000&auto=format&fit=crop"
    ],
    short: "A lightweight, packable puffer for layering on the coldest commutes.",
    description: "This is the lightest jacket we make, meant to compress into its own pocket for travel or sit as a mid-layer under something heavier. The baffles are narrower than a typical puffer, which keeps the fill from shifting and gives it a slimmer profile than the boxy version most brands default to. It's not built to be your only jacket in deep winter, but it's the one you'll reach for most often the rest of the year.",
    details: [
      "Recycled nylon shell, synthetic insulation",
      "Packs into interior chest pocket",
      "Elastic cuffs, drawcord hem",
      "Machine washable, cold and gentle",
      "True to size"
    ]
  }
];

function twfFormatPrice(n) {
  return "$" + n.toFixed(2);
}

function twfGetProduct(id) {
  return PRODUCTS.find(p => p.id === id);
}