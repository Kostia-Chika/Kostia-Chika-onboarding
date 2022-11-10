namespace lab1
{
    public class TerrestrialItem : AbstractItem
    {
        public TerrestrialTypeItem type;
        public override string ShowType()
        {
            return type.ToString();
        }
    }
}